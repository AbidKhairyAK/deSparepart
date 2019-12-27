<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js
"></script>
<script type="text/javascript">

function format_number(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

var penjualan = $('#penjualan-chart');
var penjualanData = {
    labels: {!! json_encode($chart_penjualan['label']) !!},
    datasets: [{
        label: 'Orang',
        data: {!! json_encode($chart_penjualan['data']) !!},
        backgroundColor: '#4e73df'
    }]
};
var penjualanChart = new Chart(penjualan, {
    type: 'bar',
    data: penjualanData,
    options: {
        legend: {
            display: false
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                label: function(tooltipItem, data) {
                    return tooltipItem.label + ': Rp ' + format_number(tooltipItem.value);
                }
            }
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: Math.max(...penjualanData.datasets[0].data) + (Math.max(...penjualanData.datasets[0].data) * 0.1),
                    callback: function(value, index, values) {
                        return Math.ceil(value / 1000000) + 'Jt';
                    }
                },
                gridLines: {
                    drawBorder: false,
                }
            }]
        },
        plugins: {
            labels: {
                render: function(args) { return format_number(args.value)}
            }
        }
    }
});

var pembelian = $('#pembelian-chart');
var pembelianData = {
    labels: {!! json_encode($chart_pembelian['label']) !!},
    datasets: [{
        label: 'Orang',
        data: {!! json_encode($chart_pembelian['data']) !!},
        backgroundColor: '#f6c23e'
    }]
};
var pembelianChart = new Chart(pembelian, {
    type: 'bar',
    data: pembelianData,
    options: {
        legend: {
            display: false
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                label: function(tooltipItem, data) {
                    return tooltipItem.label + ': Rp ' + format_number(tooltipItem.value);
                }
            }
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: Math.max(...pembelianData.datasets[0].data) + (Math.max(...pembelianData.datasets[0].data) * 0.1),
                    callback: function(value, index, values) {
                        return Math.ceil(value / 1000000) + 'Jt';
                    }
                },
                gridLines: {
                    drawBorder: false,
                }
            }]
        },
        plugins: {
            labels: {
                render: function(args) { return format_number(args.value)}
            }
        }
    }
});
</script>