<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Karyawan;
use App\Model\Jabatan;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class KaryawanController extends Controller
{
    public function __construct(Karyawan $table)
    {
        $this->main = 'karyawan';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = title_case($this->main);
        $this->table = $table;
        $this->middleware('permission:index-'.$this->main, ['only' => ['index','data']]);
        $this->middleware('permission:create-'.$this->main, ['only' => ['create','store']]);
        $this->middleware('permission:detail-'.$this->main, ['only' => ['show']]);
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
        // if (!$request->ajax()) { return; }
        $data = $this->table->select(['id', 'foto', 'jabatan_id', 'nama', 'phone', 'gaji']);
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->editColumn('jabatan_id', function($index) {
                return $index->jabatan->nama;
            })
            ->editColumn('gaji', function($index) {
                return 'Rp '.number_format($index->gaji, 0, '', '.');
            })
            ->editColumn('foto', function($index) {
                $foto = (!empty($index->foto) && file_exists(public_path('img_karyawan/'.$index->foto))) ? $index->foto : 'default.png';
                return "<a href='/img_karyawan/{$foto}' target='_blank'><img src='/img_karyawan/{$foto}' width='50'/></a>";
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $can = [
                    'edit'  => [
                        'link' => $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'dis' => $user->can('edit-'.$this->main) ? '' : 'disabled',
                    ],
                    'detail'  => [
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.show',$index->id) : '#',
                        'dis' => $user->can('detail-'.$this->main) ? '' : 'disabled',
                    ],
                    'delete'  => [
                        'link' => $user->can('delete-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $user->can('delete-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= "<a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                $tag .= " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' class='btn btn-danger btn-sm delete' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'foto', 'action'])
            ->make(true);
    }

    public function create(FormBuilder $formBuilder)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'POST',
            'url' => route($this->uri.'.store'),
            'enctype' => 'multipart/form-data'

        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
        // return view($this->folder.'.create', $data);
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
            'enctype' => 'multipart/form-data'
        ]);
        $data['url'] = route($this->uri.'.index');
        $data['oldImg'] =  $model->foto;
        return view($this->folder.'.form', $data);
    }

    public function show($id)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['model'] = $this->table->find($id);
        $data['url'] = route($this->uri.'.index');
        $foto = (!empty($data['model']->foto) && file_exists(public_path('img_karyawan/'.$data['model']->foto))) ? $data['model']->foto : 'default.png';
        $data['foto'] = "<a href='/img_karyawan/{$foto}' target='_blank'><img src='/img_karyawan/{$foto}' width='300'/></a>";
        return view($this->folder.'.detail', $data);
    }

    public function store(Request $request)
    {
        if ($foto = $request->file('image')) {
            $namaFoto = $this->uploadImage($foto);
            $request->merge([ 'foto' => $namaFoto ]);
        }
        $this->table->create($request->all());
        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        if ($foto = $request->file('image')) {
            $namaFoto = $this->uploadImage($foto, $request->oldImg);
            $request->merge([ 'foto' => $namaFoto ]);
        }

        $this->table->findOrFail($id)->update($request->all());
        return redirect($this->uri);
    }

    public function destroy($id)
    {
        $data = $this->table->findOrFail($id);
        $data->delete();

        if (!empty($data->foto) && file_exists(public_path('img_karyawan/'.$data->foto))) {
            unlink(public_path("img_karyawan/{$data->foto}"));
        }
        // return redirect($this->uri);
        return response()->json(['msg' => true,'success' => trans('message.delete')]);

    }

    public function uploadImage($foto, $old=false)
    {
        if ($old && !empty($data->foto) && file_exists(public_path('img_karyawan/'.$data->foto))) {
            unlink(public_path("img_karyawan/{$old}"));
        }
        $newName = time().'.'.$foto->getClientOriginalExtension();
        $foto->move(public_path('img_karyawan'), $newName);
        return $newName;
    }
}
