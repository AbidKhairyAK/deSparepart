<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\PembayaranHutang;
use DataTables;
use Form;

class PembayaranHutangController extends Controller
{
    public function __construct(PembayaranHutang $table)
    {
        $this->main = 'pembayaran-hutang';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = 'Pembayaran hutang';
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
                    ->with(['pembelian', 'user'])
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
                            <td>Faktur</td><td class='px-2'>:</td><th>{$index->pembelian->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>PO</td><td class='px-2'>:</td><th>{$index->pembelian->no_po}</th>
                        </tr>
                        <tr>
                            <td>Pelunasan</td><td class='px-2'>:</td><th>{$index->no_pelunasan}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('supplier', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Kode</td><td class='px-2'>:</td><th>{$index->pembelian->supplier->kode}</th>
                        </tr>
                        <tr>
                            <td>Perusahaan</td><td class='px-2'>:</td><th>{$index->pembelian->supplier->perusahaan}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('tanggal', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>pembelian</td><td class='px-2'>:</td><th>".substr($index->pembelian->created_at, 0, 10)."</th>
                        </tr>
                        <tr>
                            <td>Tempo</td><td class='px-2'>:</td><th>{$index->pembelian->jatuh_tempo}</th>
                        </tr>
                        <tr>
                            <td>Pelunasan</td><td class='px-2'>:</td><th>".substr($index->created_at, 0, 10)."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('hutang', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>hutang</td><td class='px-2'>:</td><th>".number_format($index->hutang, 0, '', '.')."</th>
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
                    'edit'  => [
                        'link' => $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'dis' => $user->can('edit-'.$this->main) ? '' : 'disabled',
                    ],
                    'detail'  => [
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.show',$index->id) : '#',
                        'dis' => $user->can('detail-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= " <a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'nomor', 'tanggal', 'supplier', 'hutang', 'action'])
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
            $data['m'] = DB::table('pembelian')->select('no_faktur', 'id')->where('id', $id)->first();
        }

        $prevData = $this->table->where('no_pelunasan', 'like', 'BK-'.date('y')."%")->orderBy('no_pelunasan', 'desc')->first();
        $newNo = !is_null($prevData) ? ( intval("1".substr($prevData->no_pelunasan, 5)) + 1 ) : null;
        $data['no_pelunasan'] = "BK-" . date('y') . (!is_null($prevData) ? substr($newNo, 1) : "00001");
        
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        $data['model'] = DB::table('pembayaran_hutang')->where('id', $id)->first();;
        $data['m'] = DB::table('pembelian')->select('no_faktur', 'id')->where('id', $data['model']->pembelian_id)->first();

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'status_lunas' => $request->sisa == 0,
            'hutang' => str_replace('.', '', $request->hutang),
            'sisa' => str_replace('.', '', $request->sisa),
            'dibayarkan' => $request->sisa == 0 ? str_replace('.', '', $request->hutang) : str_replace('.', '', $request->dibayarkan)
        ]);
        if ($request->sisa == 0) {
            DB::table('pembelian')->where('id', $request->pembelian_id)->update([
                'status_lunas' => '1',
            ]);
        }

        $this->table->create($request->all());

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'status_lunas' => $request->sisa == 0,
            'hutang' => str_replace('.', '', $request->hutang),
            'sisa' => str_replace('.', '', $request->sisa),
            'dibayarkan' => $request->sisa == 0 ? str_replace('.', '', $request->hutang) : str_replace('.', '', $request->dibayarkan)
        ]);
        
        DB::table('pembelian')->where('id', $request->pembelian_id)->update([
            'status_lunas' => $request->sisa == 0,
        ]);

        $this->table->find($id)->update($request->all());

        return redirect($this->uri);
    }
    
    public function destroy($id)
    {
        $data = $this->table->findOrFail($id);
        $data->delete();

        return redirect($this->uri);
    }
}
