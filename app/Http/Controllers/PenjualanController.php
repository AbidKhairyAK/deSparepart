<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use App\Model\PenjualanDetail;
use App\Model\Customer;
use App\Model\Barang;
use App\Model\Inventaris;
use Kris\LaravelFormBuilder\FormBuilder;
use DataTables;
use Form;
use PDF;

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

	public function api(Request $request, $type=false)
	{
		$search = $request->get('search');
		$piutang = $request->get('piutang');
		$id = $request->get('id');
		$customer_id = $request->get('customer_id');

		$data = $this->table;

		if (!empty($search)) {
			$data = $data->where('no_faktur', 'like', "%$search%");
		}
		if (!empty($piutang)) {
			$data = $data->where('status_lunas', 0);
		}

		if ($type=='select') {
			$data = $data->select('no_faktur', 'id')->get();
		} else if ($type=='full' && !empty($id)){
			$data = $data->with(['customer', 'penjualan_detail', 'pembayaran_piutang', 'retur_penjualan'])->find($id);
			$data->has_retur = $data->where('id', $id)->has('retur_penjualan')->exists();
		} else if ($type=='customer' && !empty($customer_id)) {
			$data = $data->where('customer_id', $customer_id)->select('no_faktur', 'id', 'created_at', 'total')->get();
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
					->with(['customer', 'user'])
					->select(['id', "user_id", "customer_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan", "created_at"])
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
			->addColumn('customer', function ($index) {
				$tag = "<table>
						<tr>
							<td>Kode</td><td class='px-2'>:</td><th>{$index->customer->kode}</th>
						</tr>
						<tr>
							<td>Nama</td><td class='px-2'>:</td><th>{$index->customer->nama}</th>
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
							<td>Penjualan</td><td class='px-2'>:</td><th>{$tgl_jual}<br>{$jam_jual}</th>
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
				$sql = "CONCAT(penjualan.no_faktur,'-',penjualan.no_po)  like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
			->filterColumn('tanggal', function($query, $keyword) {
				// $sql = "CONCAT(penjualan.created_at,'-',penjualan.jatuh_tempo)  like ?";
				$sql = "penjualan.created_at  like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
			->filterColumn('biaya', function($query, $keyword) {
				$sql = "CONCAT(penjualan.total,'-',penjualan.dibayarkan,'-',penjualan.hutang)  like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
			->filterColumn('status', function($query, $keyword) {
				$sql = "CONCAT(penjualan.status_lunas,'-',penjualan.status_post)  like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
			->rawColumns(['id', 'nomor', 'tanggal', 'customer', 'biaya', 'status', 'action'])
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
		$prevData = $this->table->max('no_faktur');
		$newNo = (!is_null($prevData) && substr($prevData, 10) != 99999) ? ( intval("1".substr($prevData, 10)) + 1 ) : null;
		$data['no_faktur'] = "NJA-" . date('y/m/') . (!is_null($newNo) ? substr($newNo, 1) : "00001");

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
		$penjualan = $this->table->create($data);
		$this->detailPenjualan($request, $penjualan->id);

		return redirect($this->uri.'/'.$penjualan->id)->with('print', true);
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
		$prevcustomer = DB::table('customer')->where('kode', 'like', date('ymd')."%")->orderBy('kode', 'desc')->first();

		if ($request->p == 'p0') {
			$customer = Customer::create([
				'user_id' => auth()->user()->id,
				'kode' => !is_null($prevcustomer) ? (intval($prevcustomer->kode) + 1) : date('ymd')."001",
				'nama' => $request->customer_nama,
				'toko' => $request->customer_toko,
				'alamat' => $request->customer_alamat,
			]);
			if ($request->customer_hp) {
				DB::table('kontak_customer')->insert([
					'customer_id' => $customer->id,
					'tipe' => 'hp',
					'kontak' => $request->customer_hp,
				]);
			}
		}
		$total = str_replace(".", "", $request->total);
		$dibayarkan = str_replace(".", "", $request->dibayarkan);
		$bayar = intval($dibayarkan) - intval($total);
		$hutang = str_replace(".", "", $request->hutang);

		$penjualan = [
			"user_id" => auth()->user()->id,
			"no_faktur" => $request->no_faktur,
			"no_po" => $request->no_po ?: '-',
			"customer_id" => $request->p == 'p0' ? $customer->id : $request->customer_id,
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

		return $penjualan;
	}

	public function detailPenjualan($request, $id, $update=false)
	{
		if ($update) {
			$pds = DB::table('penjualan_detail')->where('penjualan_id', $id);
			foreach ($pds->get() as $pd) {
				$cur = Barang::find($pd->barang_id);
				$cur->update(['stok' => ($cur->stok + $pd->qty)]);
				$this->restoreDecreaseBarang($cur, $pd->barang_id, $pd->qty);
			}
			$pds->delete();
		}

		$p = Penjualan::find($id);

		foreach ($request->barang_id as $key => $barang_id) {
		   
			$model = DB::table('barang')
					->join('satuan', 'satuan.id', '=', 'barang.satuan_id')
					->select('part_no', 'barang.nama', 'satuan.nama as satuan', 'stok')
					->where('barang.id', $barang_id)->first();

			$pd = PenjualanDetail::create([
				'penjualan_id'  => $id,
				'barang_id'     => $barang_id,
				'part_no'       => $model->part_no,
				'nama'          => $model->nama,
				'qty'           => $request->qty[$key],
				'satuan'        => $model->satuan,
				'diskon'        => $request->diskon[$key],
				'harga_asli'    => $request->harga_asli[$key],
				'harga'         => str_replace(".", "", $request->harga[$key]),
				'subtotal'      => str_replace(".", "", $request->subtotal[$key]),
				'created_at' 	=> $p->created_at,
				'updated_at' 	=> $p->updated_at,
			]);

			$b = Barang::find($barang_id);
			$b->update(['stok' => $b->stok - $request->qty[$key]]);

			$this->decreaseBarang($b, $barang_id, $request->qty[$key]);

			$inv = Inventaris::create([
			    'tanggal'               => $p->created_at,
			    'barang_id'             => $barang_id,
			    'penjualan_detail_id'   => $pd->id,
			    'trx_qty'               => $pd->qty,
			    'trx_harga'             => $pd->harga,
			    'trx_total'             => $pd->subtotal,
			]);
            
            if (!$update) {
				$this->inv_jual($inv);
			}
		}
	}

	public function inv_jual($inv, $sisa = false, $skip = 1)
    {
        $latest = DB::table('inventaris')
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('id', 'desc')
                    ->where('barang_id', $inv->barang_id)
                    ->where('tanggal', '<', $inv->tanggal)
                    ->first();

        $first = DB::table('inventaris_detail')
                    ->where('inventaris_id', $latest->id)
                    ->where('inv_stok', '>', '0')
                    ->orderBy('id')
                    ->skip($skip - 1)
                    ->take(1)
                    ->first();

        $prevs = DB::table('inventaris_detail')
                    ->where('inventaris_id', $latest->id)
                    ->where('inv_stok', '>', '0')
                    ->orderBy('id')
                    ->skip($skip)
                    ->take(PHP_INT_MAX)
                    ->get();

        $qty    = $sisa ?: $inv->trx_qty;

        if ($first && $first->inv_stok >= $qty) {
            $stok = $first->inv_stok - $qty;

            if ($stok > 0) {
	            DB::table('inventaris_detail')->insert([
	                'tanggal'       => $first->tanggal,
	                'inventaris_id' => $inv->id,
	                'inv_qty'       => $first->inv_qty,
	                'inv_stok'      => $stok,
	                'inv_harga'     => $first->inv_harga,
	                'inv_total'     => $first->inv_harga * $stok,
	            ]);
            }
            
            foreach ($prevs as $prev) {
                DB::table('inventaris_detail')->insert([
                    'tanggal'       => $prev->tanggal,
                    'inventaris_id' => $inv->id,
                    'inv_qty'       => $prev->inv_qty,
                    'inv_stok'      => $prev->inv_stok,
                    'inv_harga'     => $prev->inv_harga,
                    'inv_total'     => $prev->inv_total,
                ]);
            }

            DB::table('inventaris')->where('id', $inv->id)->update([
                'trx_qty' => $qty,
                'trx_harga' => $first->inv_harga,
                'trx_total' => $qty * $first->inv_harga,
            ]);

        } else if ($first && $first->inv_stok > 0) {
            DB::table('inventaris')->insert([
                'tanggal'               => $inv->tanggal,
                'barang_id'             => $inv->barang_id,
                'penjualan_detail_id'   => $inv->penjualan_detail_id,
                'trx_qty'               => $first->inv_stok,
                'trx_harga'             => $first->inv_harga,
                'trx_total'             => $first->inv_stok * $first->inv_harga,
            ]);

            DB::table('inventaris')->where('id', $inv->id)->update([
                'trx_qty'   => $first->inv_stok,
                'trx_harga' => $first->inv_harga,
                'trx_total' => $first->inv_stok * $first->inv_harga,
            ]);

            $new_inv = DB::table('inventaris')
                        ->where('penjualan_detail_id', $inv->penjualan_detail_id)
                        ->orderBy('id', 'desc')
                        ->first();

            $this->inv_jual($new_inv, $qty - $first->inv_stok, $skip + 1);
        } else {
        	$this->inv_minus($inv, $qty);
        }
    }

    public function inv_minus($inv, $qty)
    {
    	$b = DB::table('barang')->where('id', $inv->barang_id)->first();

    	DB::table('inventaris')->where('id', $inv->id)->update([
    	    'trx_qty' => $qty,
    	    'trx_harga' => $b->harga_beli,
    	    'trx_total' => $qty * $b->harga_beli,
    	]);

    	$minus = Inventaris::orderBy('tanggal', 'desc')
    	            ->orderBy('id', 'desc')
    	            ->where('barang_id', $inv->barang_id)
                    ->where('tanggal', '<', $inv->tanggal)
    	            ->whereHas('inventaris_detail', function($m) {
    	            	$m->where('inv_stok', '<', 0);
    	            })
    	            ->first();

    	$stok = $minus ? ($minus->inventaris_detail()->first()->inv_stok * -1) + $qty : $qty;

		DB::table('inventaris_detail')->insert([
		    'tanggal'       => $inv->tanggal,
		    'inventaris_id' => $inv->id,
		    'inv_qty'       => $stok * -1,
		    'inv_stok'      => $stok * -1,
		    'inv_harga'     => $b->harga_beli,
		    'inv_total'     => $stok * $b->harga_beli,
		]);
    }

	public function decreaseBarang($b, $id, $qty)
	{
		$pds = $b->pembelian_detail()->where('stok', '>', 0)->oldest();
		$pd = $pds->first();

		if (!empty($pd) && $pd->stok >= $qty) {
			$pds->update(['stok' => $pd->stok - $qty]);
		} elseif (!empty($pd)) {
			$pds->update(['stok' => 0]);
			$this->decreaseBarang($b, $id, $qty - $pd->stok);
			return;
		}
	}

	public function restoreDecreaseBarang($b, $id, $qty)
	{
		$apds = $b->pembelian_detail()->where('stok', '>', 0)->oldest();
		$apd = $apds->first();

		$npds = $b->pembelian_detail()->where('stok', 0)->latest();
		$npd = $npds->first();

		if (!empty($apd) && $apd->qty > $apd->stok) {
			$total = $apd->stok + $qty;
			if ($apd->qty >= $total) {
				$apds->update(['stok' => $total]);
			} else {
				$apds->update(['stok' => $apd->qty]);
				$this->restoreDecreaseBarang($b, $id, $total - $apd->qty);
				return;
			}
		} elseif (!empty($npd)) {
			if ($npd->qty >= $qty) {
				$npds->update(['stok' => $qty]);
			} else {
				$npds->update(['stok' => $npd->qty]);
				$this->restoreDecreaseBarang($b, $id, $qty - $npd->qty);
				return;
			}
		}
	}

	public function cetak($id)
	{
		$data['model'] = $this->table->find($id);
		
		// return view($this->folder.'.cetak',$data);
		return PDF::setOptions(['orientation' => 'landscape'])->loadView($this->folder.'.cetak',$data)->setPaper([0, 0, 720, 792], 'landscape')->stream();
	}

	public function suratjalan($id)
	{
		$data['model'] = $this->table->find($id);
		
		// return view($this->folder.'.cetak',$data);
		return PDF::setOptions(['orientation' => 'landscape'])->loadView($this->folder.'.surat-jalan',$data)->setPaper([0, 0, 720, 792], 'landscape')->stream();
	}

	public function tandaterima(Request $request)
	{
        $data['model'] = $this->table->whereIn('id', $request->penjualan_id);
        $data['customer'] = Customer::find($request->customer_id);

        return PDF::setOptions(['orientation' => 'potrait'])->loadView($this->folder.'.tanda-terima',$data)->setPaper([0, 0, 720, 792], 'potrait')->stream();
	}
}
