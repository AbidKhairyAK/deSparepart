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

class HutangController extends Controller
{
    public function __construct(Supplier $table)
    {
        $this->main = 'hutang';
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
        // if (!$request->ajax()) { return; }

        $data = $this->table
                    ->with(['pembelian'])
                    ->select(['id', 'kode', 'perusahaan'])
                    ->whereHas('pembelian', function($query) {
                        $query->where('status_lunas', '0');
                    })
                    ->orderBy('perusahaan', 'asc');
        return DataTables::of($data)
            ->addColumn('supplier', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Kode</td><td class='px-2'>:</td><th>{$index->kode}</th>
                        </tr>
                        <tr>
                            <td>Perusahaan</td><td class='px-2'>:</td><th>{$index->perusahaan}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('jatuh_tempo_terdekat', function ($index) {
                $pembelian = $index->pembelian()->where('status_lunas', '0')->orderBy('jatuh_tempo', 'asc')->first();
                $tag = "<table>
                        <tr>
                            <td>Tgl Tempo</td><td class='px-2'>:</td><th>{$pembelian->jatuh_tempo}</th>
                        </tr>
                        <tr>
                            <td>No Faktur</td><td class='px-2'>:</td><th>{$pembelian->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>Hutang</td><td class='px-2'>:</td><th>Rp ".number_format($pembelian->hutang, 0, '', '.')."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('total_hutang', function ($index) {
                $hutang = $index->pembelian()->where('status_lunas', '0')->sum('hutang');
                return 'Rp '.number_format($hutang, 0, '', '.');
            })
            ->addColumn('transaksi', function ($index) {
                return "Hutang ".$index->pembelian()->where('status_lunas', '0')->count('id')." Transaksi";
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
                return $tag;
            })
            ->filterColumn('supplier', function($query, $keyword) {
                $sql = "CONCAT(kode,'-',perusahaan)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['supplier', 'jatuh_tempo_terdekat', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['model'] = $this->table->find($id)->pembelian()->where('status_lunas', '0')->get();
        $data['parent'] = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['url'] = route($this->uri.'.index');
        $data['detail'] = route('pembelian.show', $id);
        $data['lunasi'] = route('pembayaran-'.$this->uri.'.create', $id);
        return view($this->folder.'.detail',$data);
    }

    public function create()
    {
        return redirect()->back();
    }

    public function edit($id)
    {
        return redirect()->back();
    }

    public function store()
    {
        return redirect()->back();
    }

    public function update($id)
    {
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        return redirect()->back();
    }
}
