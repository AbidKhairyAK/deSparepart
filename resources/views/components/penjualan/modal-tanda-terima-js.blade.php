<script type="text/javascript">
  $('.customer-select2').select2({
    ajax: {
      url: `{{ route('customer.api') }}`,
      data: function (params) {
        return {
          search: params.term,
        }
      },
      processResults: function (data) {
        return {
          results: data.map((item) => {
            return {
                text: item.name,
                id: item.id
            }
          })
        };
      }
    }
  })
  .change(function() {
    var ps = $('.penjualan-select2');

    if (ps.hasClass("select2-hidden-accessible")) {
      ps.val(null).trigger('change');
    }

    ps.removeAttr('readonly')
    .select2({
      ajax: {
        url: `{{ url('/') }}/penjualan/api/customer?customer_id=${this.value}`,
        data: function (params) {
          return {
            search: params.term,
          }
        },
        processResults: function (data) {
          return {
            results: data.map((item) => {

              return {
                  text: `${item.no_faktur}  -  ${item.created_at.substr(0,10)}  -  Rp ${item.total}`,
                  id: item.id
              }
            })
          };
        }
      }
    });

    @if(isset($model))
      if (ps.hasClass('firsttime')) {
        @php $p = $model; @endphp
        var text = `{{ $p->no_faktur }}  -  {{ substr($p->created_at,0,10) }}  -  Rp {{ $p->total }}`;
        var newOption = new Option(text,`{{ $p->id }}`, true, true);
        ps.removeClass('firsttime').append(newOption).trigger('change');
      }
    @endif

  });

  @if(isset($model))
  $('.customer-select2').trigger('change');
  @endif
</script>