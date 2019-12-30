<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Model\History;
use App\Model\User;

class HistoryController extends Controller
{
    public function __construct(History $table)
    {
        $this->main = 'history';
        $this->folder = 'components.'.$this->main;
        $this->uri = $this->main;
        $this->title = title_case($this->main);
        $this->table = $table;
        $this->fullUrl = isset(explode('?', url()->full())[1]) ? route($this->uri.'.data').'?'.explode('?', url()->full())[1] : route($this->uri.'.data');

        $this->middleware('permission:index-'.$this->main, ['only' => ['index','data']]);
        $this->middleware('permission:detail-'.$this->main, ['only' => ['show']]);
        $this->middleware('permission:delete-'.$this->main, ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['ajax'] = $this->fullUrl;

        // $data['ajax'] = route($this->uri.'.data');
        // $data['create'] = route($this->uri.'.create');
        $data['url'] = route($this->uri.'.index');
        $data['user'] = User::all();
        $data['selectedUser'] = ($request->user)?$request->user:false;
        $data['selectedTabel'] = ($request->tabel)?$request->tabel:false;
        $data['selectedEvent'] = ($request->event)?$request->event:false;
        $data['tanggal'] = ($request->tanggal)?$request->tanggal:false;
        // $audit = $data->audits()->latest()->first();
        // dd($audit->getMetadata());
        // dd($data['audits']);
        $tabel = $this->table->select('auditable_type')->groupBy('auditable_type')->pluck('auditable_type');
        $custom = $tabel->map(function ($item, $key) {
            return explode("\\", $item)[2];
        });
        $data['tabel'] = $custom;
        $data['event'] = $this->table->select('event')->groupBy('event')->pluck('event');
        return view('components.history.index', $data);
    }


    public function data(Request $request)
    {
        // if (!$request->ajax()) { return; }

        $data = $this->table->orderBy('created_at', 'desc')->select(['id', 'user_id', 'auditable_type', 'event', 'created_at']);
        if ($request->user) {
            $data = $data->where('user_id', $request->user);
        }
        if ($request->event) {
            $data = $data->where('event', $request->event);
        }
        if ($request->tabel) {
            $data = $data->where('auditable_type', "App\Model\\".ucfirst($request->tabel));
        }
        if ($request->tanggal) {
            $data = $data->whereDate('created_at', $request->tanggal);
        }
        return DataTables::of($data)
            ->editColumn('user_id', function ($index) {
                return $index->user->username;
            })
            ->editColumn('auditable_type', function ($index) {
                return explode("\\",$index->auditable_type)[2];
            })
            ->addColumn('action', function ($index) {
                $user = auth()->user();
                $can = [
                    'detail'  => [
                        'link' => $user->can('detail-'.$this->main) ? route($this->uri.'.show',$index->id) : '#',
                        'dis' => $user->can('detail-'.$this->main) ? '' : 'disabled',
                    ],
                ];
                $tag = " <a href='{$can['detail']['link']}' class='btn btn-info btn-sm {$can['detail']['dis']}' title='detail'><i class='fas fa-eye'></i></a>";
                // $tag = " <a href='".route($this->uri.'.show',$index->id)."' class='btn btn-info btn-sm' title='detail'><i class='fas fa-eye'></i></a>";
                return $tag;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data['value'] = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['url'] = route($this->uri.'.index');
        return view($this->folder.'.detail',$data);
    }
}
