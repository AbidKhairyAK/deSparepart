<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;

class PenggunaController extends Controller
{

    public function __construct(User $table)
    {
        $this->main = 'pengguna';
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

        $data = $this->table->select(['id', 'username', 'email', 'role_id', 'last_login', 'created_at', 'status']);
        return DataTables::of($data)
            ->editColumn('id', function($index) {
                if ($index->id == auth()->user()->id) {
                    return null;
                }
                $tag = '<label class="d-block">';
                $tag .= '<input type="checkbox" class="checkbox" name="id[]" value="'.$index->id.'" onclick="test()"/>';
                $tag .= '</label>';
                return $tag;
            })
            ->addColumn('role', function ($index) {
                return $index->role->name;
            })
            ->editColumn('status', function ($index) {
                $status = $index->status ? 'aktif' : 'nonaktif';
                $color = $index->status ? 'primary' : 'warning';
                return '<span class="badge badge-'.$color.'">'.$status.'</span>';
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $checkself = $index->id != $user->id;
                $can = [
                    'edit'  => [
                        'link1' => $checkself && $user->can('edit-'.$this->main) ? route($this->uri.'.edit',$index->id) : '#',
                        'link2' => $checkself && $user->can('edit-'.$this->main) ? route($this->uri.'.deactivate', $index->id) : '#',
                        'link3' => $checkself && $user->can('edit-'.$this->main) ? route($this->uri.'.activate', $index->id) : '#',
                        'dis' => $checkself && $user->can('edit-'.$this->main) ? '' : 'disabled',
                    ],
                    'delete'  => [
                        'link' => $checkself && $user->can('delete-'.$this->main) ? route($this->uri.'.destroy',$index->id) : '#',
                        'dis' => $checkself && $user->can('delete-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = Form::open(array("url" => $can['delete']['link'], "method" => "DELETE"));
                $tag .= "<a href='{$can['edit']['link1']}' class='btn btn-primary btn-sm {$can['edit']['dis']}' title='edit'><i class='fas fa-edit'></i></a>";

                if ($index->status) {
                    $tag .= " <a href='{$can['edit']['link2']}' class='btn btn-warning btn-sm {$can['edit']['dis']}' title='nonaktifkan'><i class='fas fa-power-off'></i></a>";
                } else {
                    $tag .= " <a href='{$can['edit']['link3']}' class='btn btn-success btn-sm {$can['edit']['dis']}' title='aktifkan'><i class='fas fa-power-off'></i></a>";
                }

                $tag .= " <button {$can['delete']['dis']} type='submit' onclick='return confirm(`apa anda yakin?`)' class='btn btn-danger btn-sm' title='hapus'><i class='fas fa-trash'></i></button>";
                $tag .= Form::close();
                return $tag;
            })
            ->rawColumns(['id', 'status', 'action'])
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
    }

    public function edit(FormBuilder $formBuilder, $id)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['form'] = $formBuilder->create("App\Forms\\{$this->title}Form", [
            'method' => 'PUT',
            'model' => $this->table->find($id),
            'url' => route($this->uri.'.update', $id)
        ]);
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $this->table->create($request->all());
    	return redirect($this->uri);
    }

    public function update(Request $request, $id)
    {
    	$request->validate([
            'email' => 'unique:users,email,'.$id,
            'password' => 'confirmed',
            'password_confirmation' => 'required_with:password',
        ]);
        $this->table->findOrFail($id)->update($request->all());
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
