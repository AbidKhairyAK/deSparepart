<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Pembelian;
use App\Model\PembelianDetail;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\PembayaranHutang;
use App\Model\Barang;
use DataTables;
use Form;

class ReturPembelianController extends Controller
{
    public function __construct(ReturPembelian $table)
    {
        $this->main = 'retur-pembelian';
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

        $data = $this->table->join('pembelian', 'pembelian.id', '=', 'retur_pembelian.pembelian_id')
            ->join('retur_pembelian_detail', 'retur_pembelian_detail.retur_pembelian_id', '=', 'retur_pembelian.id')
            ->select(DB::raw('
                    pembelian.no_faktur, 
                    pembelian.created_at as tgl_jual, 
                    retur_pembelian.id, 
                    retur_pembelian.no_retur, 
                    retur_pembelian.dikembalikan,
                    retur_pembelian.dikurangi,
                    retur_pembelian.pembayaran, 
                    retur_pembelian.created_at as tgl_retur'
                ))
            ->groupBy('retur_pembelian_detail.retur_pembelian_id')
            ->orderBy('retur_pembelian.created_at', 'desc');


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
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= " <a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                // $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->filterColumn('kode', function($query, $keyword) {
                $sql = "CONCAT(pembelian.no_faktur,'-',retur_pembelian.no_retur) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('total', function($query, $keyword) {
                $sql = "CONCAT(retur_pembelian.dikurangi,'-',retur_pembelian.dikembalikan) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tanggal', function($query, $keyword) {
                $sql = "CONCAT(pembelian.created_at,'-',retur_pembelian.created_at) like ?";
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
            $data['m'] = DB::table('pembelian')->select('no_faktur', 'id')->where('id', $id)->first();
        }
        
        $prevData = $this->table->max('no_retur');
        $newNo = (!is_null($prevData) && substr($prevData, 10) != 99999) ? ( intval("1".substr($prevData, 10)) + 1 ) : null;
        $data['no_retur'] = "RTB-" . date('y/m/') . (!is_null($newNo) ? substr($newNo, 1) : "00001");

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        $data['model'] = $this->table->with('retur_pembelian_detail')->find($id);
        $data['m'] = DB::table('pembelian')->select('no_faktur', 'id')->where('id', $data['model']->pembelian_id)->first();

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $p = Pembelian::find($request->pembelian_id);

        if ($request->dikurangi) {
            $sisa_hutang = $p->hutang - removedot($request->dikurangi);
            $p->update([
                'hutang' => $sisa_hutang,
                'status_lunas' => $sisa_hutang == 0,
            ]);
        }

        $rp = ReturPembelian::create([
            'user_id' => auth()->user()->id,
            'pembelian_id' => $request->pembelian_id,
            'no_retur' => $request->no_retur,
            'pembayaran' => $request->pembayaran,
            'pembayaran_detail' => $request->pembayaran_detail,
            'dikurangi' => removedot($request->dikurangi) ?: 0,
            'dikembalikan' => removedot($request->dikembalikan) ?: 0,
        ]);

        $rpd = $request->qty;
        foreach ($rpd as $key => $value) {
            if ($value > 0) {
                ReturPembelianDetail::create([
                    'user_id' => auth()->user()->id,
                    'retur_pembelian_id' => $rp->id,
                    'pembelian_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => removedot($request->biaya[$key]),
                    'keterangan' => $request->keterangan[$key]
                ]);

                PembelianDetail::find($key)->increment('retur', $value);

                Barang::find($request->barang_id[$key])->increment('stok', $value);
            }
        }

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $model = ReturPembelian::find($id);

        $sisa_hutang = ($model->pembelian->hutang + intval($request->dikurangi_sebelumnya)) - intval(removedot($request->dikurangi));

        $model->pembelian->update([
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

        $old_rpd = ReturPembelianDetail::where('retur_pembelian_id', $id);
        foreach ($old_rpd->get() as $o) {
            $o->pembelian_detail->update(['retur' => 0]);
            $o->pembelian_detail->barang->decrement('stok', $o->qty);
        }
        $old_rpd->delete();

        $rpd = $request->qty;
        foreach ($rpd as $key => $value) {
            if ($value > 0) {
                ReturPembelianDetail::create([
                    'user_id' => auth()->user()->id,
                    'retur_pembelian_id' => $id,
                    'pembelian_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => removedot($request->biaya[$key]),
                    'keterangan' => $request->keterangan[$key]
                ]);

                PembelianDetail::find($key)->update(['retur' => $value]);

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
}