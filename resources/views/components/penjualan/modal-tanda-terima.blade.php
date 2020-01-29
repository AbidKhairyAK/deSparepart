<div class="modal fade" id="modal-tanda-terima">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form target="_blank" action="{{ route('penjualan.tanda-terima') }}">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cetak Tanda Terima</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label>Customer</label>
            <select class="form-control customer-select2" name="customer_id" style="width: 100%;" required>
              @if(isset($model))
                @php $c = $model->customer; @endphp
                <option value="{{ $c->id }}" selected>
                  {{ $c->kode }}  -  {{ $c->nama }}
                </option>
              @endif
            </select>
          </div>

          <div class="form-group">
            <label>Faktur</label>
            <select class="form-control penjualan-select2 firsttime" name="penjualan_id[]" multiple="true" style="width: 100%;" required readonly>
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