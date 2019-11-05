<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\PembayaranPiutang;
use App\Model\Barang;
use DataTables;
use Form;

class ReturPenjualanController extends Controller
{
    public function __construct(ReturPenjualan $table)
    {
        $this->main = 'retur-penjualan';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = title_case($this->main);
        $this->table = $table;
        $this->middleware('permission:index-'.$this->main, ['only' => ['index','data']]);
        $this->middleware('permission:detail-'.$this->main, ['only' => ['show']]);
        $this->middleware('permission:create-'.$this->main, ['only' => ['create','store']]);
        $this->middleware('permission:edit-'.$this->main, ['only' => ['edit','update']]);
        $this->middleware('permission:delete-'.$this->main, ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['create'] = route($this->uri.'.create');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.index',$data);
    }

    public function data(Request $request)
    {
        // if (!$request->ajax()) { return; }

        $data = ReturPenjualan::join('penjualan', 'penjualan.id', '=', 'retur_penjualan.penjualan_id')
            ->join('retur_penjualan_detail', 'retur_penjualan_detail.retur_penjualan_id', '=', 'retur_penjualan.id')
            ->select(DB::raw('SUM(retur_penjualan_detail.biaya) as biaya, COUNT(retur_penjualan_detail.retur_penjualan_id) as barang, penjualan.no_faktur, retur_penjualan.id, retur_penjualan.created_at, retur_penjualan.dikembalikan, retur_penjualan.dilunaskan, retur_penjualan.pembayaran'))
            ->groupBy('retur_penjualan_detail.retur_penjualan_id');

        $table = DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('no_faktur', function($index) {
                return $index->no_faktur;
            })
            ->addColumn('barang', function ($index) {
                return $index->barang." jenis";
            })
            ->addColumn('biaya', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Dikembalikan</td><td class='px-2'>:</td><th>".number_format($index->dikembalikan, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Dilunaskan</td><td class='px-2'>:</td><th>".number_format($index->dilunaskan, 0, '', '.')."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $can = [
                    'edit'  => [
                        'link' => $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'dis' => $user->can('edit-'.$this->main) ? '' : 'disabled',
                    ],
                    'delete'  => [
                        'link' => $user->can('delete-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $user->can('delete-'.$this->main) ? '' : 'disabled',
                    ],
                    'detail'  => [
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $user->can('detail-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= "<a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->filterColumn('no_faktur', function($query, $keyword) {
                $sql = "penjualan.no_faktur like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'biaya', 'action'])
            ->make(true);

        return $table;
    }

    public function create(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $data['m'] = DB::table('penjualan')->select('no_faktur', 'id')->where('id', $id)->first();
        }

        $prevData = PembayaranPiutang::where('no_pelunasan', 'like', 'BM-'.date('y')."%")->orderBy('no_pelunasan', 'desc')->first();
        $newNo = !is_null($prevData) ? ( intval("1".substr($prevData->no_pelunasan, 5)) + 1 ) : null;
        $data['no_pelunasan'] = "BM-" . date('y') . (!is_null($prevData) ? substr($newNo, 1) : "00001");

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->no_pelunasan) {
            $pp = PembayaranPiutang::create([
                'user_id' => auth()->user()->id,
                'penjualan_id' => $request->penjualan_id,
                'no_pelunasan' => $request->no_pelunasan,
                'piutang' => str_replace('.', '', $request->piutang),
                'dibayarkan' => str_replace('.', '', $request->dilunaskan),
                'sisa' => str_replace('.', '', $request->sisa),
                'pembayaran' => $request->pembayaran,
                'pembayaran_detail' => $request->pembayaran_detail,
                'status_lunas' => $request->sisa == 0,
            ]);

            if ($request->sisa == 0) {
                Penjualan::where('id', $request->penjualan_id)->update([
                    'status_lunas' => '1',
                ]);
            }
        }

        $rp = ReturPenjualan::create([
            'user_id' => auth()->user()->id,
            'penjualan_id' => $request->penjualan_id,
            'pembayaran_piutang_id' => isset($pp) ? $pp->id : null,
            'pembayaran' => $request->pembayaran,
            'pembayaran_detail' => $request->pembayaran_detail,
            'dilunaskan' => $request->dilunaskan>0 ? str_replace('.', '', $request->dilunaskan) : null,
            'dikembalikan' => $request->dikembalikan>0 ? str_replace('.', '', $request->dikembalikan) : null,
        ]);

        $rpd = $request->qty;
        foreach ($rpd as $key => $value) {
            if ($value > 0) {
                ReturPenjualanDetail::create([
                    'user_id' => auth()->user()->id,
                    'retur_penjualan_id' => $rp->id,
                    'penjualan_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => $request->biaya[$key],
                    'keterangan' => $request->keterangan[$key],
                ]);

                Barang::find($request->barang_id[$key])->increment('stok', $value);
            }
        }

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);

        $tbl = $this->table->findOrFail($id);
        $tbl->update($request->all());
        $tbl->kontak_customer()->delete();
        for ($i=0; $i < count($request->kontak); $i++) { 
            $tbl->kontak_customer()->create([
                'tipe' => $request->tipe[$i],
                'kontak' => $request->kontak[$i],
            ]);
        }
        return redirect($this->uri);
    }

    public function deactivate($id)
    {
        $this->table->findOrFail($id)->update(['status' => 0]);
        return redirect($this->uri);
    }

    public function activate($id)
    {
        $this->table->findOrFail($id)->update(['status' => 1]);
        return redirect($this->uri);
    }

    public function destroy($id)
    {
        $this->table->findOrFail($id)->delete();
        return redirect($this->uri);
    }
}
