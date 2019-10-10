<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\PembayaranPiutang;
use DataTables;
use Form;

class PembayaranPiutangController extends Controller
{
    public function __construct(PembayaranPiutang $table)
    {
        $this->main = 'pembayaran-piutang';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = 'Pembayaran Piutang';
        $this->table = $table;
        $this->middleware('permission:index-'.$this->main, ['only' => ['index','data']]);
        $this->middleware('permission:detail-'.$this->main, ['only' => ['show']]);
        $this->middleware('permission:create-'.$this->main, ['only' => ['create','store']]);
        $this->middleware('permission:edit-'.$this->main, ['only' => ['edit','update']]);
        $this->middleware('permission:delete-'.$this->main, ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['ajax'] = route($this->uri.'.data');
        $data['create'] = route($this->uri.'.create');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.index',$data);
    }


    public function data(Request $request)
    {
        if (!$request->ajax()) { return; }

        $data = $this->table
                    ->with(['penjualan', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('nomor', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Faktur</td><td class='px-2'>:</td><th>{$index->penjualan->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>PO</td><td class='px-2'>:</td><th>{$index->penjualan->no_po}</th>
                        </tr>
                        <tr>
                            <td>Pelunasan</td><td class='px-2'>:</td><th>{$index->no_pelunasan}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('customer', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Kode</td><td class='px-2'>:</td><th>{$index->penjualan->customer->kode}</th>
                        </tr>
                        <tr>
                            <td>Nama</td><td class='px-2'>:</td><th>{$index->penjualan->customer->nama}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('tanggal', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Penjualan</td><td class='px-2'>:</td><th>".substr($index->penjualan->created_at, 0, 10)."</th>
                        </tr>
                        <tr>
                            <td>Tempo</td><td class='px-2'>:</td><th>{$index->penjualan->jatuh_tempo}</th>
                        </tr>
                        <tr>
                            <td>Pelunasan</td><td class='px-2'>:</td><th>".substr($index->created_at, 0, 10)."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('piutang', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Piutang</td><td class='px-2'>:</td><th>".number_format($index->piutang, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Dibayarkan</td><td class='px-2'>:</td><th>".number_format($index->dibayarkan, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Sisa</td><td class='px-2'>:</td><th>".($index->sisa ? number_format($index->sisa, 0, '', '.') : '-')."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('status', function($index) {
                $tag = $index->status_lunas ? 'Lunas' : 'Belum Lunas';
                return $tag;
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $can = [
                    'delete'  => [
                        'link' => $user->can('delete-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $user->can('delete-'.$this->main) ? '' : 'disabled',
                    ],
                    'detail'  => [
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.show',$index->id) : '#',
                        'dis' => $user->can('detail-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'nomor', 'tanggal', 'customer', 'piutang', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['model'] = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.detail',$data);
    }

    public function create(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $data['m'] = DB::table('penjualan')->select('no_faktur', 'id')->where('id', $id)->first();
        }

        $prevData = $this->table->where('no_pelunasan', 'like', 'BM-'.date('y')."%")->orderBy('no_pelunasan', 'desc')->first();
        $newNo = !is_null($prevData) ? ( intval("1".substr($prevData->no_pelunasan, 5)) + 1 ) : null;
        $data['no_pelunasan'] = "BM-" . date('y') . (!is_null($prevData) ? substr($newNo, 1) : "00001");

        $data['no_faktur'] = '0'.rand(1,9).rand(0,1).'.00'.rand(1,4).'-'.date('y').'.0000'.rand(1000,9999);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'status_lunas' => $request->sisa == 0,
            'piutang' => str_replace('.', '', $request->piutang),
            'sisa' => str_replace('.', '', $request->sisa),
            'dibayarkan' => $request->sisa == 0 ? str_replace('.', '', $request->piutang) : str_replace('.', '', $request->dibayarkan)
        ]);
        if ($request->sisa == 0) {
            DB::table('penjualan')->where('id', $request->penjualan_id)->update([
                'status_lunas' => '1',
            ]);
        }

        $this->table->create($request->all());

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $data = $this->table->findOrFail($id);
        $data->delete();

        return redirect($this->uri);
    }
}
