<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Pembelian;
use App\Model\Supplier;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;
use PDF;

class PembelianController extends Controller
{
    public function __construct(Pembelian $table)
    {
        $this->main = 'pembelian';
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

    public function api(Request $request, $type=false)
    {
        $search = $request->get('search');
        $hutang = $request->get('hutang');
        $id = $request->get('id');

        $data = $this->table;

        if (!empty($search)) {
            $data = $data->where('no_faktur', 'like', "%$search%");
        }
        if (!empty($hutang)) {
            $data = $data->where('status_lunas', 0);
        }

        if ($type=='select') {
            $data = $data->select('no_faktur', 'id')->get();
        } else if ($type=='full' && !empty($id)){
            $data = $data->with(['supplier', 'pembelian_detail', 'pembayaran_hutang'])->where('id', $id)->first();
        }

        return response()->json($data);
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
                    ->with(['supplier', 'user'])
                    ->select(['id', "user_id", "supplier_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan", "created_at"])
                    ->orderBy('created_at', 'desc');
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
                            <td>Faktur</td><td class='px-2'>:</td><th>{$index->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>PO</td><td class='px-2'>:</td><th>{$index->no_po}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('supplier', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Kode</td><td class='px-2'>:</td><th>{$index->supplier->kode}</th>
                        </tr>
                        <tr>
                            <td>Perusahaan</td><td class='px-2'>:</td><th>{$index->supplier->perusahaan}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('tanggal', function ($index) {
                $tgl_beli = substr($index->created_at, 0, 10);
                $jam_beli = substr($index->created_at, 11);
                $tag = "<table>
                        <tr>
                            <td>Pembelian</td><td class='px-2'>:</td><th>{$tgl_beli}<br>{$jam_beli}</th>
                        </tr>
                        <tr>
                            <td>Tempo</td><td class='px-2'>:</td><th>{$index->jatuh_tempo}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('biaya', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Harga</td><td class='px-2'>:</td><th>".number_format($index->total, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Dibayar</td><td class='px-2'>:</td><th>".number_format($index->dibayarkan, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Hutang</td><td class='px-2'>:</td><th>".($index->hutang ? number_format($index->hutang, 0, '', '.') : '-')."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('kasir', function($index) {
                return $index->user->username;
            })
            ->addColumn('status', function($index) {
                $tag = "<div>
                        <div><span class='badge badge-".($index->status_lunas ? 'success' : 'warning')."'>".($index->status_lunas ? 'Lunas' : 'Belum Lunas')."</span></div>
                        <div><span class='badge badge-".($index->status_post ? 'primary' : 'secondary')."'>".($index->status_post ? 'Publish' : 'Draft')."</span></div>
                    </div>
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
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.show',$index->id) : '#',
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
            ->filterColumn('nomor', function($query, $keyword) {
                $sql = "CONCAT(pembelian.no_faktur,'-',pembelian.no_po)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tanggal', function($query, $keyword) {
                $sql = "CONCAT(pembelian.created_at,'-',pembelian.jatuh_tempo)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('biaya', function($query, $keyword) {
                $sql = "CONCAT(pembelian.total,'-',pembelian.dibayarkan,'-',pembelian.hutang)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('status', function($query, $keyword) {
                $sql = "CONCAT(pembelian.status_lunas,'-',pembelian.status_post)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'nomor', 'tanggal', 'supplier', 'biaya', 'status', 'action'])
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

    public function create()
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $data = $this->mappingData($request);
        $pembelian = $this->table->create($data);
        $this->detailPembelian($request, $pembelian->id);

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $data = $this->mappingData($request, true);
        $this->table->find($id)->update($data);
        $this->detailPembelian($request, $id, true);

        return redirect($this->uri);
    }
    
    public function destroy($id)
    {
        $data = $this->table->findOrFail($id);
        $data->delete();

        return redirect($this->uri);
    }

    public function mappingData($request, $update=false)
    {
        $total = str_replace(".", "", $request->total);
        $dibayarkan = str_replace(".", "", $request->dibayarkan);
        $bayar = intval($dibayarkan) - intval($total);
        $hutang = str_replace(".", "", $request->hutang);

        $pembelian = [
            "user_id" => auth()->user()->id,
            "no_faktur" => $request->no_faktur,
            "no_po" => $request->no_po,
            "supplier_id" => $request->supplier_id,
            "keterangan" => $request->keterangan,
            "total" => $total,
            "pembayaran" => $request->pembayaran,
            "pembayaran_detail" => $request->pembayaran_detail,
            "dibayarkan" => $bayar > 0 ? $total : $dibayarkan,
            "hutang" => $hutang,
            "jatuh_tempo" => $request->jatuh_tempo,
            "status_lunas" => $request->hutang == 0,
            "status_post" => $request->publish > 0 ? '1' : '0',
        ];

        return $pembelian;
    }

    public function detailPembelian($request, $id, $update=false)
    {
        if ($update) {

            $pds = DB::table('pembelian_detail')->where('pembelian_id', $id);

            $toSave = clone $pds;
            $created_time = $toSave->pluck('created_at', 'barang_id');
            $save = $toSave->whereColumn('qty', '>', 'stok')->get();

            foreach ($pds->get() as $pd) {
                $cur = DB::table('barang')->where('id', $pd->barang_id)->first();
                DB::table('barang')->where('id', $pd->barang_id)->update(['stok' => ($cur->stok - $pd->qty)]);
            }
            $pds->delete();
        }
        foreach ($request->barang_id as $key => $barang_id) {
           
            $model = DB::table('barang')
                    ->join('satuan', 'satuan.id', '=', 'barang.satuan_id')
                    ->select('part_no', 'barang.nama', 'satuan.nama as satuan', 'stok')
                    ->where('barang.id', $barang_id)->first();

            $prev = null;
            if (isset($save)) {
                foreach($save as $s) {
                    if ($s->barang_id == $barang_id) {
                        $prev = $s;
                    }
                }
            }

            DB::table('pembelian_detail')->insert([
                'pembelian_id'  => $id,
                'barang_id'     => $barang_id,
                'part_no'       => $model->part_no,
                'nama'          => $model->nama,
                'qty'           => $request->qty[$key],
                'stok'          => $prev ? $prev->stok : $request->qty[$key],
                'satuan'        => $model->satuan,
                'diskon'        => $request->diskon[$key],
                'ppn'           => $request->ppn[$key],
                'harga_asli'    => $request->harga_asli[$key],
                'harga'         => str_replace(".", "", $request->harga[$key]),
                'subtotal'      => str_replace(".", "", $request->subtotal[$key]),
                'created_at'    => array_key_exists($barang_id, $created_time) ? $created_time[$barang_id] : now(),
                'updated_at'    => now(),
            ]);
            DB::table('barang')
                ->where('id', $barang_id)
                ->update(['stok' => ($model->stok + $request->qty[$key]) ]);
        }
    }
}
