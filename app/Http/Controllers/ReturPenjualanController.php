<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\ReturPenjualan;
use App\Model\PembayaranPiutang;
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
        $data['type'] = $request->get('type') ?: 'barang';
        $data['create'] = route($this->uri.'.create');
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.index',$data);
    }

    public function data(Request $request, $type)
    {
        // if (!$request->ajax()) { return; }

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

        if ($type == 'barang') {
            $data = $this->table->with('penjualan_detail.barang')
                ->join('penjualan_detail', 'retur_penjualan.penjualan_detail_id', '=', 'penjualan_detail.id')
                ->join('penjualan', 'retur_penjualan.penjualan_id', '=', 'penjualan.id')
                ->select(['retur_penjualan.id', 'retur_penjualan.penjualan_id', 'penjualan_detail_id', 'retur_penjualan.qty', 'retur_penjualan.biaya', 'retur_penjualan.pembayaran', 'retur_penjualan.created_at'])
                ->orderBy('retur_penjualan.created_at', 'desc');

            $table = DataTables::of($data)
                ->addColumn('identitas', function ($index) {
                    $tag = "<table>
                            <tr>
                                <td>No Faktur</td><td class='px-2'>:</td><th>{$index->penjualan->no_faktur}</th>
                            </tr>
                            <tr>
                                <td>Part No</td><td class='px-2'>:</td><th>{$index->penjualan_detail->part_no}</th>
                            </tr>
                            <tr>
                                <td>Nama Barang</td><td class='px-2'>:</td><th>{$index->penjualan_detail->nama}</th>
                            </tr>
                        </table>
                    ";
                    return $tag;
                })
                ->editColumn('qty', function ($index) {
                    return $index->qty." ".$index->penjualan_detail->satuan;
                })
                ->filterColumn('identitas', function($query, $keyword) {
                    $sql = "CONCAT(penjualan.no_faktur,'-',penjualan_detail.part_no,'-',penjualan_detail.nama)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn('qty', function($query, $keyword) {
                    $sql = "CONCAT(retur_penjualan.qty,'-',penjualan_detail.satuan)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                });
        }
        elseif ($type == 'penjualan') {
            $data = $this->table
                ->join('penjualan', 'retur_penjualan.penjualan_id', '=', 'penjualan.id')
                ->select(DB::raw('retur_penjualan.id, sum(biaya) as biaya, count(penjualan_id) as jumlah, penjualan_id, penjualan.total'))
                ->groupBy('penjualan_id')
                ->orderBy('retur_penjualan.created_at', 'desc');

            $table = DataTables::of($data)
                ->addColumn('barang', function ($index) {
                    return $index->jumlah." jenis";
                })
                ->editColumn('total', function($index) {
                    return number_format($index->total, 0, '', '.');
                })
                ->addColumn('no_faktur', function($index) {
                    return $index->penjualan->no_faktur;
                })
                ->filterColumn('no_faktur', function($query, $keyword) {
                    $sql = "penjualan.no_faktur like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                });
        }

        $table = $table->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->editColumn('biaya', function($index) {
                return number_format($index->biaya, 0, '', '.');
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
            ->rawColumns(['id', 'barang', 'identitas', 'action'])
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
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['m'] = $this->table->find($id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $l = $request->qty;

        foreach ($l as $key => $value) {
            if ($value > 0) {
                $data[] = [
                    'user_id' => auth()->user()->id,
                    'penjualan_id' => $request->penjualan_id,
                    'penjualan_detail_id' => $key,
                    'qty' => $value,
                    'biaya' => $request->biaya[$key],
                    'pembayaran' => $request->pembayaran,
                    'keterangan' => $request->keterangan[$key],
                ];
            }
        }

        dd($data);
        // $request->merge([
        //     'user_id' => auth()->user()->id,
        //     'status_lunas' => $request->sisa == 0,
        //     'piutang' => str_replace('.', '', $request->piutang),
        //     'sisa' => str_replace('.', '', $request->sisa),
        //     'dibayarkan' => $request->sisa == 0 ? str_replace('.', '', $request->piutang) : str_replace('.', '', $request->dibayarkan)
        // ]);
        // if ($request->sisa == 0) {
        //     DB::table('penjualan')->where('id', $request->penjualan_id)->update([
        //         'status_lunas' => '1',
        //     ]);
        // }

        // $this->table->create($request->all());

        // return redirect($this->uri);
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
