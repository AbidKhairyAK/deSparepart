<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Permission;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class HakAksesController extends Controller
{
    public function __construct(Role $table)
    {
        $this->main = 'hak-akses';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = 'Hak Akses';
        $this->table = $table;
        // $this->middleware('permission:index-'.$this->main, ['only' => ['index','data']]);
        // $this->middleware('permission:detail-'.$this->main, ['only' => ['show']]);
        // $this->middleware('permission:create-'.$this->main, ['only' => ['create','store']]);
        // $this->middleware('permission:edit-'.$this->main, ['only' => ['edit','update']]);
        // $this->middleware('permission:delete-'.$this->main, ['only' => ['destroy']]);
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

        $data = $this->table->select(['id', 'name']);
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                if ($index->id == auth()->user()->role->id) {
                    return null;
                }
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('count', function ($index) {
                return $index->permissions()->count();
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $checkAdmin = $index->id != 1;
                $can = [
                    'edit'  => [
                        'link' => $checkAdmin && $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'dis' => $checkAdmin && $user->can('edit-'.$this->main) ? '' : 'disabled',
                    ],
                    'delete'  => [
                        'link' => $checkAdmin && $user->can('delete-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $checkAdmin && $user->can('delete-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= "<a href='{$can['edit']['link']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";
                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'action'])
            ->make(true);
    }

    public function create(FormBuilder $formBuilder)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\HakAksesForm", [
            'method' => 'POST',
            'url' => route($this->uri.'.store')
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function edit(FormBuilder $formBuilder, $id)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\HakAksesForm", [
            'method' => 'PUT',
            'model' => $this->table->find($id),
            'url' => route($this->uri.'.update', $id)
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => str_slug($request->name)
        ]);
        $tbl = $this->table->create($request->all());
        $tbl->permissions()->sync($request->permissions);
        return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
        $tbl = $this->table->findOrFail($id);
        $tbl->update($request->all());
        $tbl->permissions()->sync($request->permissions);
        return redirect($this->uri);
    }

    public function destroy($id)
    {
        $this->table->findOrFail($id)->delete();
        return redirect($this->uri);
    }
}
