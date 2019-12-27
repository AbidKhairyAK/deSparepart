<div class="row mb-4">

  <div class="col-md-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penjualan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_penjualan, 0, '', '.') }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pembelian</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_pembelian, 0, '', '.') }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-left-secondary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Laba Kotor</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_profit, 0, '', '.') }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>