<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Customer;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class CustomerController extends Controller
{
    public function __construct(Customer $table)
    {
        $this->main = 'customer';
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
        $id = $request->get('id');

        if ($id) {
            $data = $this->table->with('kontak_customer')->find($id);
        } else {
            $data = $this->table->select(DB::raw('CONCAT(kode," - ",nama) as name, id'));
            if (!empty($search)) {
                $data = $data->where('nama', 'like', "%$search%")
                            ->orWhere('kode', 'like', "%$search%");
            }
            $data = $data->get();
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
        // if (!$request->ajax()) { return; }

        $data = $this->table->with('kontak_customer')->select(['id', 'kode', 'nama', 'toko', 'alamat', 'kategori', 'status']);
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('identitas', function ($index) {
                $tag = "<div class='d-flex'>
                        <span>
                            <div>Kode</div>
                            <div>Nama</div>
                            <div>Toko</div>
                        </span>
                        <span class='px-2'>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                        </span>
                        <span>
                            <div><b>{$index->kode}</b></div>
                            <div><b>{$index->nama}</b></div>
                            <div><b>{$index->toko}</b></div>
                        </span>
                    </div>
                ";
                return $tag;
            })
            ->addColumn('kontak', function ($index) {
                $tag = '';
                foreach ($index->kontak_customer()->get() as $con) {
                    $tag .= "<div><i class='fas fa-".($con->tipe == 'hp' ? 'mobile-alt' : 'envelope')." mr-1'></i> {$con->kontak}</div>";
                }
                return $tag;
            })
            ->editColumn('status', function ($index) {
                $status = $index->status ? 'aktif' : 'nonaktif';
                $color = $index->status ? 'primary' : 'warning';
                return '<span class="badge badge-'.$color.'">'.$status.'</span>';
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $can = [
                    'edit'  => [
                        'link1' => $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'link2' => $user->can('edit-'.$this->main) ? route($this->uri.'.deactivate', $index->id) : '#',
                        'link3' => $user->can('edit-'.$this->main) ? route($this->uri.'.activate', $index->id) : '#',
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
                $tag .= "<a href='{$can['edit']['link1']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                // $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";

                if ($index->status) {
                    $tag .= " <a href='{$can['edit']['link2']}' class='btn btn-warning btn-sm {$can['edit']['dis']}' title='nonaktifkan'><i class='fas fa-power-off'></i></a>";
                } else {
                    $tag .= " <a href='{$can['edit']['link3']}' class='btn btn-success btn-sm {$can['edit']['dis']}' title='aktifkan'><i class='fas fa-power-off'></i></a>";
                }

                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->filterColumn('identitas', function($query, $keyword) {
                $sql = "CONCAT(customer.kode,'-',customer.nama,'-',customer.toko)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['id', 'identitas', 'kontak', 'status', 'action'])
            ->make(true);
    }

    public function create(FormBuilder $formBuilder)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'POST',
            'url' => route($this->uri.'.store')
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
        // return view($this->folder.'.create', $data);
    }

    public function edit(FormBuilder $formBuilder, $id)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['tbl'] = $this->table->find($id);
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'PUT',
            'model' => $data['tbl'],
            'url' => route($this->uri.'.update', $id)
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $prevData = $this->table->where('kode', 'like', date('ymd')."%")->orderBy('kode', 'desc')->first();
        $request->merge([
            'user_id' => auth()->user()->id,
            'kode' => !is_null($prevData) ? (intval($prevData->kode) + 1) : date('ymd')."001",
        ]);

        $tbl = $this->table->create($request->all());
        for ($i=0; $i < count($request->kontak); $i++) { 
            $tbl->kontak_customer()->create([
                'tipe' => $request->tipe[$i],
                'kontak' => $request->kontak[$i],
            ]);
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
