<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use App\Model\Customer;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;
use PDF;

class PiutangController extends Controller
{
    public function __construct(Customer $table)
    {
        $this->main = 'piutang';
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
                    ->with(['penjualan'])
                    ->select(['id', 'kode', 'nama'])
                    ->whereHas('penjualan', function($query) {
                        $query->where('status_lunas', '0');
                    })
                    ->orderBy('nama', 'asc');
        return DataTables::of($data)
            ->addColumn('customer', function ($index) {
                $tag = "<table>
                        <tr>
                            <td>Kode</td><td class='px-2'>:</td><th>{$index->kode}</th>
                        </tr>
                        <tr>
                            <td>Nama</td><td class='px-2'>:</td><th>{$index->nama}</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('jatuh_tempo_terdekat', function ($index) {
                $penjualan = $index->penjualan()->where('status_lunas', '0')->orderBy('jatuh_tempo', 'asc')->first();
                $tag = "<table>
                        <tr>
                            <td>Tgl Tempo</td><td class='px-2'>:</td><th>{$penjualan->jatuh_tempo}</th>
                        </tr>
                        <tr>
                            <td>No Faktur</td><td class='px-2'>:</td><th>{$penjualan->no_faktur}</th>
                        </tr>
                        <tr>
                            <td>Hutang</td><td class='px-2'>:</td><th>Rp ".number_format($penjualan->hutang, 0, '', '.')."</th>
                        </tr>
                    </table>
                ";
                return $tag;
            })
            ->addColumn('total_piutang', function ($index) {
                $hutang = $index->penjualan()->where('status_lunas', '0')->sum('hutang');
                return 'Rp '.number_format($hutang, 0, '', '.');
            })
            ->addColumn('transaksi', function ($index) {
                return "Hutang ".$index->penjualan()->where('status_lunas', '0')->count('id')." Transaksi";
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
            ->filterColumn('customer', function($query, $keyword) {
                $sql = "CONCAT(kode,'-',nama)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['customer', 'jatuh_tempo_terdekat', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['model'] = $this->table->find($id)->penjualan()->where('status_lunas', '0')->get();
        $data['parent'] = $this->table->find($id);
        $data['main'] = $this->main;
        $data['title'] = $this->title;
        $data['url'] = route($this->uri.'.index');
        $data['detail'] = route('penjualan.show', $id);
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
