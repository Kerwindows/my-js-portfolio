$(document).ready(function() {
    var chart;

    function initializeChart(data, categories) {
        var options = {
            chart: {
                height: 170,
                type: "line",
                toolbar: {
                    show: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            series: [{
                name: "Health",
                color: '#00D3C7',
                data: data
            }],
            xaxis: {
                categories: categories,
            }
        };

        chart = new ApexCharts(document.querySelector("#health-chart"), options);
        chart.render();
    }

    // Since healthCategories are already month names, no conversion is needed for initial setup
    initializeChart(healthData, healthCategories);

    // Update chart on year change
    $('#yearSelect').change(function() {
        var selectedYear = $(this).val();
        var selectedYearData = allHealthData[selectedYear] ? Object.values(allHealthData[selectedYear]) : [];
        var selectedYearMonths = allHealthData[selectedYear] ? Object.keys(allHealthData[selectedYear]) : [];

        // Assuming selectedYearMonths are month numbers that need to be converted
        var monthNames = selectedYearMonths.map(monthNum => {
            // Ensure monthNum is treated as a number
            const date = new Date(0, parseInt(monthNum, 10) - 1);
            return date.toLocaleString('default', { month: 'short' });
        });

        chart.updateOptions({
            series: [{
                data: selectedYearData
            }],
            xaxis: {
                categories: monthNames
            }
        });
    });
});