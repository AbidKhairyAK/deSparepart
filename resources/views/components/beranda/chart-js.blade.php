<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js
"></script>
<script type="text/javascript">

function format_number(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

var penjualan = $('#penjualan-chart');
var penjualanData = {
    labels: ['05 Juli', '06 Juli', '07 Juli', '08 Juli', '09 Juli', '10 Juli', '11 Juli', '12 Juli', '13 Juli', '14 Juli'],
    datasets: [{
        label: 'Orang',
        data: [2100000, 4100000, 6200000, 2500000, 1700000, 5600000, 3100000, 1300000, 1600000, 3700000],
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
                    stepSize: 1000000,
                    max: Math.max(...penjualanData.datasets[0].data) + 1000000,
                    callback: function(value, index, values) {
                        return (value / 1000000) + 'Jt';
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
    labels: ['05 Juli', '06 Juli', '07 Juli', '08 Juli', '09 Juli', '10 Juli', '11 Juli', '12 Juli', '13 Juli', '14 Juli'],
    datasets: [{
        label: 'Orang',
        data: [2100000, 4100000, 6200000, 2500000, 1700000, 5600000, 3100000, 1300000, 1600000, 3700000],
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
                    stepSize: 1000000,
                    max: Math.max(...pembelianData.datasets[0].data) + 1000000,
                    callback: function(value, index, values) {
                        return (value / 1000000) + 'Jt';
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