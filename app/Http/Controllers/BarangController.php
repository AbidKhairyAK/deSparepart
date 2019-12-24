<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Barang;
use App\Model\Satuan;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class BarangController extends Controller
{
    public function __construct(Barang $table)
    {
        $this->main = 'barang';
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
    
    public function api(Request $request)
    {
        $search = $request->get('search');

        $data = DB::table('barang')
            ->rightJoin('satuan', 'satuan.id', '=', 'barang.satuan_id')
            ->select(DB::raw("CONCAT(part_no,' - ',barang.nama,' - merk ',merk,' - ',satuan.nama) as name, barang.id, harga_jual, harga_beli"));

        if (!empty($search)) {
            $data = $data->where('barang.nama', 'like', "%$search%")
                        ->orWhere('part_no', 'like', "%$search%")
                        ->orWhere('merk', 'like', "%$search%")
                        ->orWhere('satuan.nama', 'like', "%$search%");
        }

        $data = $data->get();

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
                    ->join('kendaraan', 'barang.kendaraan_id', '=', 'kendaraan.id')
                    ->join('komponen', 'barang.komponen_id', '=', 'komponen.id')
                    ->select(['barang.id', 'komponen_id', 'kendaraan_id', 'satuan_id', 'part_no', 'barang.nama', 'barang.merk', 'stok', 'limit', 'harga_beli', 'harga_jual', 'keterangan', 'gambar', 'barang.created_at'])
                    ->orderBy('created_at', 'desc');
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('satuan', function($index) {
                return $index->satuan->nama;
            })
            ->editColumn('gambar', function($index) {
                $gambar = (!empty($index->gambar) && file_exists(public_path('img/'.$index->gambar))) ? $index->gambar : 'default.png';
                return "<a href='/img/{$gambar}' target='_blank'><img src='/img/{$gambar}' width='50'/></a>";
            })
            ->editColumn('stok', function($index) {
                $color = '';
                if ($index->stok <= 0) { $color = 'text-danger'; }
                elseif ($index->stok <= $index->limit) { $color = 'text-warning'; }

                return "<span class='{$color}'>{$index->stok}</span>";
            })
            ->addColumn('identitas', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Nama Barang</td><td class='px-2'>:</td><th>{$index->nama}</th>
                        </tr><tr>
                            <td>Merk</td><td class='px-2'>:</td><th>{$index->merk}</th>
                        </tr>
                        <tr>
                            <td>Komponen</td><td class='px-2'>:</td><th>{$index->komponen->nama}</th>
                        </tr>
                        <tr>
                            <td>Kendaraan</td><td class='px-2'>:</td><th>{$index->kendaraan->merk}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('harga', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Hrg Beli</td><td class='px-2'>:</td><th>".number_format($index->harga_beli, 0, '', '.')."</th>
                        </tr>
                        <tr>
                            <td>Hrg Jual</td><td class='px-2'>:</td><th>".number_format($index->harga_jual, 0, '', '.')."</th>
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
            ->filterColumn('identitas', function($query, $keyword) {
                $sql = "CONCAT(barang.nama,'-',barang.merk,'-',komponen.nama,'-',kendaraan.merk)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('harga', function($query, $keyword) {
                $sql = "CONCAT(barang.harga_jual,'-',barang.harga_beli)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'gambar', 'harga', 'stok', 'identitas', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['model'] = $this->table->where('id', $id)->with('kendaraan', 'komponen', 'pembelian_detail', 'inventaris.inventaris_detail')->first();


        $invs = $data['model']->inventaris()->orderBy('tanggal')->orderBy('id', 'desc');

        $data['invs'] = $invs->get();

        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.detail',$data);
    }

    public function create(FormBuilder $formBuilder)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'POST',
            'url' => route($this->uri.'.store'),
            'enctype' => "multipart/form-data"
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit(FormBuilder $formBuilder, $id)
    {
        $model = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'PUT',
            'model' => $model,
            'url' => route($this->uri.'.update', $id),
            'enctype' => "multipart/form-data"
        ]);
        $data['url'] = route($this->uri.'.index');
        $data['oldImg'] =  $model->gambar;
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $request->merge([ 'user_id' => auth()->user()->id ]);

        $check_satuan = Satuan::where('id', $request->satuan_id)->exists();
        if (!$check_satuan) {
            $satuan = Satuan::create(['nama' => $request->satuan_id]);
            $request->merge([ 'satuan_id' => $satuan->id ]);
        }

        if ($gambar = $request->file('image')) {
            $namaGambar = $this->uploadImage($gambar);
            $request->merge([ 'gambar' => $namaGambar ]);
        }

        $this->table->create($request->all());
        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $request->merge([ 'user_id' => auth()->user()->id ]);

        $check_satuan = Satuan::where('id', $request->satuan_id)->exists();
        if (!$check_satuan) {
            $satuan = Satuan::create(['nama' => $request->satuan_id]);
            $request->merge([ 'satuan_id' => $satuan->id ]);
        }
        
        if ($gambar = $request->file('image')) {
            $namaGambar = $this->uploadImage($gambar, $request->oldImg);
            $request->merge([ 'gambar' => $namaGambar ]);
        }

        $this->table->findOrFail($id)->update($request->all());
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

    public function uploadImage($gambar, $old=false)
    {
        if ($old && !empty($data->gambar) && file_exists(public_path('img/'.$data->gambar))) {
            unlink(public_path("img/{$old}"));
        }
        $newName = time().'.'.$gambar->getClientOriginalExtension();
        $gambar->move(public_path('img'), $newName);
        return $newName;
    }
}
