<div class="modal fade" id="modal-form">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form target="_blank" action="{{ route('barang.cetak') }}">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cetak Stok Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label>Tanggal</label>
            <input class="form-control datepicker" name="tanggal" value="{{ date('Y-m-d') }}">
          </div>

          <div class="form-group">
            <label>Nama Barang</label>
            <select class="form-control select2" name="barang_id[]" multiple="true" style="width: 100%;">
            </select>
          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>

    </div>
  </div>
</div>