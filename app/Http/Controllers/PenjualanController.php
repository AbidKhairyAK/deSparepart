<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use App\Model\Pelanggan;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class PenjualanController extends Controller
{
    public function __construct(Penjualan $table)
    {
        $this->main = 'penjualan';
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
                    ->with(['pelanggan', 'user'])
                    ->select(['id', "user_id", "pelanggan_id", "no_faktur", "no_nota", "pembayaran", "dibayarkan", "hutang", "status_hutang", "status_post", "jatuh_tempo", "total", "keterangan", "created_at"])
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
                            <td>No Faktur</td><td class='px-2'>:</td><th>{$index->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>No Nota</td><td class='px-2'>:</td><th>{$index->no_nota}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('pembeli', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>{$index->pelanggan->kode}</td>
                        </tr>
                        <tr>
                            <th width='150'>{$index->pelanggan->nama}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('tanggal', function ($index) {
                $tgl_jual = substr($index->created_at, 0, 10);
                $jam_jual = substr($index->created_at, 11);
                $tag = "<table>
                        <tr>
                            <td>Tgl Jual</td><td class='px-2'>:</td><th>{$tgl_jual}<br>{$jam_jual}</th>
                        </tr>
                        <tr>
                            <td>Tgl Tempo</td><td class='px-2'>:</td><th>{$index->jatuh_tempo}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('biaya', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Ttl Harga</td><td class='px-2'>:</td><th>".number_format($index->total, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Ttl Bayar</td><td class='px-2'>:</td><th>".number_format($index->dibayarkan, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Ttl Hutang</td><td class='px-2'>:</td><th>".($index->hutang ? number_format($index->hutang, 0, '', '.') : '-')."</th>
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
                        <div><span class='badge badge-".($index->status_hutang ? 'success' : 'warning')."'>".($index->status_hutang ? 'Lunas' : 'Belum Lunas')."</span></div>
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
                $sql = "CONCAT(penjualan.no_faktur,'-',penjualan.no_nota)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tanggal', function($query, $keyword) {
                $sql = "CONCAT(penjualan.created_at,'-',penjualan.jatuh_tempo)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('biaya', function($query, $keyword) {
                $sql = "CONCAT(penjualan.total,'-',penjualan.dibayarkan,'-',penjualan.hutang)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('status', function($query, $keyword) {
                $sql = "CONCAT(penjualan.status_hutang,'-',penjualan.status_post)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'nomor', 'tanggal', 'pembeli', 'biaya', 'status', 'action'])
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
        $data['no_faktur'] = '0'.rand(1,9).rand(0,1).'.00'.rand(1,4).'-'.date('y').'.00000'.rand(100,999);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.store');;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit($id)
    {
        $data['m'] = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['action'] = route($this->uri.'.update', $id);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $data = $this->mappingData($request);
        $penjualan = $this->table->create($data);
        $this->detailPenjualan($request, $penjualan->id);

        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $data = $this->mappingData($request, true);
        $this->table->find($id)->update($data);
        $this->detailPenjualan($request, $id, true);

        return redirect($this->uri);
    }
    
    public function destroy($id)
    {
        $data = $this->table->findOrFail($id);
        $data->delete();

        if (!empty($data->gambar) && file_exists(public_path('img/'.$data->gambar))) {
            unlink(public_path("img/{$data->gambar}"));
        }

        return redirect($this->uri);
    }

    public function mappingData($request, $update=false)
    {
        $prevData = $this->table->where('no_nota', 'like', date('ymd')."%")->orderBy('no_nota', 'desc')->first();
        $prevPelanggan = DB::table('pelanggan')->where('kode', 'like', date('ymd')."%")->orderBy('kode', 'desc')->first();
        $nota = !is_null($prevData) ? (intval($prevData->no_nota) + 1) : date('ymd')."001";
        $no_nota = $update ? $request->no_nota : $nota;
        // $tempo = explode("-", $request->jatuh_tempo);

        if ($request->p == 'p0') {
            $pelanggan = Pelanggan::create([
                'user_id' => auth()->user()->id,
                'kode' => !is_null($prevPelanggan) ? (intval($prevPelanggan->kode) + 1) : date('ymd')."001",
                'nama' => $request->pelanggan_nama,
                'toko' => $request->pelanggan_toko,
                'alamat' => $request->pelanggan_alamat,
            ]);
            DB::table('kontak_pelanggan')->insert([
                'pelanggan_id' => $pelanggan->id,
                'tipe' => 'hp',
                'kontak' => $request->pelanggan_hp,
            ]);
        }
        $total = str_replace(".", "", $request->total);
        $pembayaran = str_replace(".", "", $request->pembayaran);
        $dibayarkan = str_replace(".", "", $request->dibayarkan);
        $bayar = intval($dibayarkan) - intval($total);
        $hutang = str_replace(".", "", $request->hutang);

        $penjualan = [
            "user_id" => auth()->user()->id,
            "no_faktur" => $request->no_faktur,
            "no_nota" => $no_nota,
            "pelanggan_id" => $request->p == 'p0' ? $pelanggan->id : $request->pelanggan_id,
            "keterangan" => $request->keterangan,
            "total" => $total,
            "pembayaran" => $pembayaran,
            "dibayarkan" => $bayar > 0 ? $total : $dibayarkan,
            "hutang" => $hutang,
            "jatuh_tempo" => $request->jatuh_tempo,
            "status_hutang" => $request->hutang == 0,
            "status_post" => $request->publish > 0 ? '1' : '0',
        ];

        return $penjualan;
    }

    public function detailPenjualan($request, $id, $update=false)
    {
        if ($update) {
            DB::table('penjualan_detail')->where('penjualan_id', $id)->delete();
        }
        foreach ($request->barang_id as $key => $barang_id) {
            $model = DB::table('barang')->where('id', $barang_id)->first();
            DB::table('penjualan_detail')->insert([
                'penjualan_id' => $id,
                'barang_id' => $barang_id,
                'part_no' => $model->part_no,
                'nama' => $model->nama,
                'qty' => $request->qty[$key],
                'harga' => str_replace(".", "", $request->harga[$key]),
                'subtotal' => str_replace(".", "", $request->subtotal[$key]),
            ]);
        }
    }
}
