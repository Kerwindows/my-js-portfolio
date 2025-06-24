<?php

if (!defined('PROJECT_PATH')) {
    header("Location: ../../../../we-see-you.php");
    exit();
}
require(LINKWI_CLASSES_PATH . "/links.count.php");
$R = new LinkCount;
?>

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Link History</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Links</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!--content-header-->

<section class="content">
    <div class="container">

        <div class="row">
            <div class=" card col-12">
                <p class="text-center">
                    <strong>Custom Active Links Chart</strong>
                </p>

                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="myChart" height="120" style="height: 120px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
        </div>



        <div class="row">
            <div class="card col-12 shadow">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Link Name</th>
                                <th>Link Url</th>
                                <th>Link Count</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $id = $infouser['UniqueID'];
                            $db = new dbase;
                            $db->query("SELECT * FROM Link_Archive WHERE UniqueID = :id  ");
                            $db->bind(':id', $id, PDO::PARAM_STR);
                            $rows = $db->fetchMultiple();
                            foreach ($rows as $row) {
                                $id = $row["id"];
                                $linkname = $row["link_title"];
                                $linkurl = $row["link_url"];
                                $linkcount = $row["Count"];



                                print "<tr>
                  <td></td>
                    
                    <td>$linkname</td>
                    <td>$linkurl</td>
                    <td>$linkcount</td>
                    <td>
                    <button type='button' name='delete_btn' data-id3='" . $row['id'] . "' class='btn btn-xs btn-danger btn_delete'>x</button>
                    
                    </td>
                  </tr>";
                            }
                            $db = NULL; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Link Name</th>
                                <th>Link Url</th>
                                <th>Link Count</th>
                                <th>Delete</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>



<script>
    $(document).ready(function() {



        $(document).on('click', '.btn_delete', function() {
            var id = $(this).data("id3");
            if (confirm("Are you sure you want to delete this? Once deleted there is no way to get back the record.")) {
                $.ajax({
                    url: "pages/view/linkstable/delete.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "text",
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            }
        });
    });
</script>



<script>
    const ctx1 = document.getElementById('myChart').getContext('2d');
    const Link = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: <?php echo $R->user_LinkShow($infouser['UniqueID']); ?>,
            datasets: [{
                    label: ' ',
                    data: <?php echo $R->getLinkCount($infouser['UniqueID']); ?>,
                    backgroundColor: [
                        'red'


                    ],
                    borderColor: [
                        'red'

                    ],
                    borderWidth: 1
                },



            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 0
                    },
                    position: 'bottom',
                }
            }
        }
    });
</script>