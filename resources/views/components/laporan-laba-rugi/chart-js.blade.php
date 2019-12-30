<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js
"></script>
<script type="text/javascript">

function format_number(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

var labels = {!! json_encode($chart['label']) !!};
var data = {!! json_encode($chart['data']) !!};
var laba = $('#laba-chart');
var labaData = {
    labels: labels.reverse(),
    datasets: [{
        label: 'Orang',
        data: data.reverse(),
        backgroundColor: '#4e73df'
    }]
};
var labaChart = new Chart(laba, {
    type: 'bar',
    data: labaData,
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
                    max: Math.max(...labaData.datasets[0].data) + ( Math.max(...labaData.datasets[0].data) * 0.1),
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