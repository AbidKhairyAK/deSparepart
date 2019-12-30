<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-secondary">Laporan Laba Rugi</h6>
		<div>
			<a href="#" class="btn btn-sm btn-primary">
				<i class="fas fa-print"></i> <b>Cetak</b>
			</a>
		</div>
	</div>
	<div class="card-body">
		
		<table class="table table-sm table-borderless table-striped">
			<tbody>
				<tr>
					<td>Total Penjualan</td>
					<td>{{ rupiah($laba->total_penjualan) }}</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Retur Penjualan</td>
					<td style="border-bottom: 1px solid #85879677">{{ rupiah($laba->retur_penjualan) }}</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Penjualan Bersih</b></td>
					<td></td>
					<td></td>
					<td><b>{{ rupiah($laba->penjualan_bersih) }}</b></td>
				</tr>

				<tr>
					<td>.</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td>Total Pembelian</td>
					<td>{{ rupiah($laba->total_pembelian) }}</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Retur Pembelian</td>
					<td style="border-bottom: 1px solid #85879677">{{ rupiah($laba->retur_pembelian) }}</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Pembelian Bersih</b></td>
					<td></td>
					<td><b>{{ rupiah($laba->pembelian_bersih) }}</b></td>
					<td></td>
				</tr>
				<tr>
					<td>Persediaan Awal</td>
					<td></td>
					<td style="border-bottom: 1px solid #85879677">{{ rupiah($laba->persediaan_awal) }}</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>{{ rupiah($laba->persediaan_siap_jual) }}</b></td>
					<td></td>
				</tr>
				<tr>
					<td>Persediaan Akhir</td>
					<td></td>
					<td style="border-bottom: 1px solid #85879677">{{ rupiah($laba->persediaan_akhir) }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Harga Pokok Penjualan</b></td>
					<td></td>
					<td></td>
					<td style="border-bottom: 1px solid #85879677"><b>{{ rupiah($laba->hpp) }}</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				
			</tbody>

			<tfoot class="bg-secondary text-light mt-3">	
				<tr>
					<td><b>Laba/Rugi Kotor</b></td>
					<td></td>
					<td></td>
					<td><b>{{ rupiah($laba->laba_kotor) }}</b></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>