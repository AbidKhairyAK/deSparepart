<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use App\Model\PenjualanDetail;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\PembayaranPiutang;
use App\Model\Barang;
use DataTables;
use Form;
use PDF;

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

        $data = $this->table->join('penjualan', 'penjualan.id', '=', 'retur_penjualan.penjualan_id')
            ->join('retur_penjualan_detail', 'retur_penjualan_detail.retur_penjualan_id', '=', 'retur_penjualan.id')
            ->select(DB::raw('
                    penjualan.no_faktur, 
                    penjualan.created_at as tgl_jual, 
                    retur_penjualan.id, 
                    retur_penjualan.no_retur, 
                    retur_penjualan.dikembalikan,
                    retur_penjualan.dikurangi,
                    retur_penjualan.pembayaran, 
                    retur_penjualan.created_at as tgl_retur'
                ))
            ->groupBy('retur_penjualan_detail.retur_penjualan_id')
            ->orderBy('retur_penjualan.created_at', 'desc');


        $table = DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('kode', function($index) {
                $tag = "<table>
                        <tr>
                            <td>No Faktur</td><td class='px-2'>:</td><th>".$index->no_faktur."</th>
                        </tr>
                        <tr>
                            <td>No Retur</td><td class='px-2'>:</td><th>".$index->no_retur."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('tanggal', function($index) {
                $tag = "<table>
                        <tr>
                            <td>Tgl Jual</td><td class='px-2'>:</td><th>".substr($index->tgl_jual, 0, 10)."</th>
                        </tr>
                        <tr>
                            <td>Tgl Retur</td><td class='px-2'>:</td><th>".substr($index->tgl_retur, 0, 10)."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('total', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Dikembalikan</td><td class='px-2'>:</td><th>".rupiah($index->dikembalikan)."</th>
                        </tr>
                        <tr>
                            <td>Dikurangi</td><td class='px-2'>:</td><th>".rupiah($index->dikurangi)."</th>
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
                    'cetak'  => [
                        'link' => route($this->uri.'.cetak',$index->id),
                        'dis' => '',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= "<a href='{$can['cetak']['link']}' target='_blank' class='btn btn-info btn-sm {$can['cetak']['dis']}' title='cetak'><i class='fas fa-print'></i></a>";
                $tag .= " <a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                // $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->filterColumn('kode', function($query, $keyword) {
                $sql = "CONCAT(penjualan.no_faktur,'-',retur_penjualan.no_retur) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('total', function($query, $keyword) {
                $sql = "CONCAT(retur_penjualan.dikurangi,'-',retur_penjualan.dikembalikan) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tanggal', function($query, $keyword) {
                $sql = "CONCAT(penjualan.created_at,'-',retur_penjualan.created_at) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'kode', 'total', 'tanggal', 'action'])
            ->make(true);

        return $table;
    }

    public function create(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            $data['m'] = DB::table('penjualan')->select('no_faktur', 'id')->where('id', $id)->first();
        }
        
        $prevData = $this->table->max('no_retur');
        $newNo = (!is_null($prevData) && substr($prevData, 10) != 99999) ? ( intval("1".substr($prevData, 10)) + 1 ) : null;
        $data['no_retur'] = "XXX-" . date('y/m/') . (!is_null($newNo) ? substr($newNo, 1) : "00001");

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        $data['model'] = $this->table->with('retur_penjualan_detail')->find($id);
        $data['m'] = DB::table('penjualan')->select('no_faktur', 'id')->where('id', $data['model']->penjualan_id)->first();

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $p = Penjualan::find($request->penjualan_id);

        if ($request->dikurangi) {
            $sisa_hutang = $p->hutang - removedot($request->dikurangi);
            $p->update([
                'hutang' => $sisa_hutang,
                'status_lunas' => $sisa_hutang == 0,
            ]);
        }

        $rp = ReturPenjualan::create([
            'user_id' => auth()->user()->id,
            'penjualan_id' => $request->penjualan_id,
            'no_retur' => $request->no_retur,
            'pembayaran' => $request->pembayaran,
            'pembayaran_detail' => $request->pembayaran_detail,
            'dikurangi' => removedot($request->dikurangi) ?: 0,
            'dikembalikan' => removedot($request->dikembalikan) ?: 0,
        ]);

        $rpd = $request->qty;
        foreach ($rpd as $key => $value) {
            if ($value > 0) {
                ReturPenjualanDetail::create([
                    'user_id' => auth()->user()->id,
                    'retur_penjualan_id' => $rp->id,
                    'penjualan_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => removedot($request->biaya[$key]),
                    'keterangan' => $request->keterangan[$key]
                ]);

                PenjualanDetail::find($key)->increment('retur', $value);

                Barang::find($request->barang_id[$key])->increment('stok', $value);
            }
        }

        return redirect($this->uri)->with('print', route('retur-penjualan.cetak', $rp->id));;
    }

    public function update(Request $request, $id)
    {
        $model = ReturPenjualan::find($id);

        $sisa_hutang = ($model->penjualan->hutang + intval($request->dikurangi_sebelumnya)) - intval(removedot($request->dikurangi));

        $model->penjualan->update([
            'hutang' => $sisa_hutang,
            'status_lunas' => $sisa_hutang == 0,
        ]);

        $rp = $model->update([
            'user_id' => auth()->user()->id,
            'pembayaran' => $request->pembayaran,
            'pembayaran_detail' => $request->pembayaran_detail,
            'dikembalikan' => removedot($request->dikembalikan) ?: 0,
            'dikurangi' => removedot($request->dikurangi) ?: 0,
        ]);

        $old_rpd = ReturPenjualanDetail::where('retur_penjualan_id', $id);
        foreach ($old_rpd->get() as $o) {
            $o->penjualan_detail->update(['retur' => 0]);
            $o->penjualan_detail->barang->decrement('stok', $o->qty);
        }
        $old_rpd->delete();

        $rpd = $request->qty;
        foreach ($rpd as $key => $value) {
            if ($value > 0) {
                ReturPenjualanDetail::create([
                    'user_id' => auth()->user()->id,
                    'retur_penjualan_id' => $id,
                    'penjualan_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => removedot($request->biaya[$key]),
                    'keterangan' => $request->keterangan[$key]
                ]);

                PenjualanDetail::find($key)->update(['retur' => $value]);

                Barang::find($request->barang_id[$key])->increment('stok', $value);
            }
        }

        return redirect($this->uri);
    }

    public function destroy($id)
    {
        $this->table->findOrFail($id)->delete();
        return redirect($this->uri);
    }

    public function cetak($id)
    {
        $data['model'] = $this->table->with('penjualan', 'retur_penjualan_detail')->find($id);
        
        // return view($this->folder.'.cetak',$data);
        return PDF::setOptions(['orientation' => 'landscape'])->loadView($this->folder.'.cetak',$data)->setPaper([0, 0, 720, 792], 'landscape')->stream();
    }
}
