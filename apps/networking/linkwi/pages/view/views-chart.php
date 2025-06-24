<style>
    /*---------hide first column------------*/
    tr *:nth-child(1) {
        display: none;
    }
</style>
<!-- Main content -->
<section class="content pt-3">
    <div class="container">
        <!-- Info boxes -->

        <!------>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-sm-9">Views Data</div>
                            <div class="col col-sm-3">
                                <input type="text" id="daterange_textbox" class="form-control" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="chart-container pie-chart">
                                <canvas id="bar_chart" height="70"> </canvas>
                            </div>
                            <table class="table table-striped table-bordered" id="order_table">
                                <thead>
                                    <tr>
                                        <th id='uni'>ID</th>
                                        <th>Country</th>
                                        <th>Views</th>


                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!------>
    </div>
</section>
<script>
    /*------------table chart-------------*/
    $(document).ready(function() {
        let uniqueid = "<?php echo $UniqueID ?>";
        fetch_data();

        var sale_chart;

        function fetch_data(start_date = '', end_date = '') {
            var dataTable = $('#order_table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "includes/ajax/chart/php/display.views.php",
                    type: "POST",
                    data: {
                        action: 'fetch',
                        uniqueid: uniqueid,
                        start_date: start_date,
                        end_date: end_date
                    }
                },
                "drawCallback": function(settings) {
                    var sales_date = [];
                    var sale = [];

                    for (var count = 0; count < settings.aoData.length; count++) {
                        sales_date.push(settings.aoData[count]._aData[2]);
                        sale.push(parseFloat(settings.aoData[count]._aData[1]));
                    }

                    var chart_data = {
                        labels: sales_date,
                        datasets: [{
                            data: sale,
                            label: 'Clicks',
                            backgroundColor: '#007bff',
                            color: '#fff',
                            radius: 1,

                        }]
                    };

                    var group_chart3 = $('#bar_chart');

                    if (sale_chart) {
                        sale_chart.destroy();
                    }

                    sale_chart = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data
                    });
                }
            });
        }

        $('#daterange_textbox').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            format: 'YYYY-MM-DD'
        }, function(start, end) {

            $('#order_table').DataTable().destroy();

            fetch_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), uniqueid);

        });

    });
</script>