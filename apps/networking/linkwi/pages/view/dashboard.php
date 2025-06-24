<?php
//Click_view
if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date_time('Y');
}

if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date_time('m');
}
require(LINKWI_CLASSES_PATH . "/social.views.php");
require(LINKWI_CLASSES_PATH . '/social.clicks.php');
require(LINKWI_CLASSES_PATH . '/social.click-new.php');
require(LINKWI_CLASSES_PATH . "/social.counts.php");

if ($infouser['Role'] == 'Corp') {
    //get users
    $db = new dbase;
    $db->query("SELECT Organization, IndustryType, User_Banner_Image FROM Users WHERE Username = '" . $infouser['Username'] . "' ");
    $get_corporate_user = $db->fetchSingle(); // Assumes fetchSingle() fetches a single user.

    $db->query("SELECT *, Null as Password, Null as tempPassword,Null as bcryptPassword  FROM Users WHERE Username = '" . $infouser['Username'] . "' ");
    $get_users = $db->fetchMultiple();
    $db->closeConnection();

    $users_array = [];

    foreach ($get_users as $get) {
        $user_data = [
            'Organization' => $get_corporate_user['Organization'],
            'IndustryType' => $get_corporate_user['IndustryType'],
            'User_Banner_Image' => $get_corporate_user['User_Banner_Image'],
            'Username' => $get['corporateUsername'],
            'UniqueID' => $get['UniqueID'],
            'FirstName' => $get['FirstName'],
            'LastName' => $get['LastName'],
            'BusinessEmailAddress' => $get['BusinessEmailAddress'],
            'Job' => $get['Job'],
            'BusinessContact' => $get['BusinessContact'],
            'ProfileImage' => $get['ProfileImage'],
            'color' => $get['color'],
            'Image_one' => $get['Image_one'],
            'Bio' => $get['Bio']
        ];
        $users_array[] = $user_data;
    }

    if (isset($_GET['user'])) {
        $getUser = $_GET['user'];
    } else {
        $getUser = $get_users[0]['UniqueID'];
    }
} else {
    $getUser = $infouser['UniqueID'];
}





$View = new SocialViews($getUser, $month, $year);
$R = new CitysCount;
$S = new SocialCount;
$sClick = new SocialClickCount($getUser, $month, $year); //social.clicks.php
$sClick->todays_date = Date('d');
$sClick->monthDaysCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$socialMediaCLicks = new SocialCounts($getUser); // this class stems from social.click-new.php 

?>
<!-- Main content -->
<section class="content">
    <div class="container">
        <section class="content-header pl-0">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6 pl-0">
                        <h1>Dashboard Stats</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </section>
        <?php if ($infouser['Role'] == 'Corp') { ?>
            <div class="row">
                <article class="col-md-12">
                    <div class="mb-4">
                        <div class="box-profile">
                            <div class="image">
                                <?php foreach ($users_array as $user) { ?>
                                    <a href="?dashboard&user=<?php echo $user['UniqueID'] ?>"><img src="images/profile-images/<?php echo  $user['ProfileImage'] ?>" class="img-circle elevation-2 aside-profileimg users-page" alt="User Image"></a>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        <?php } ?>
        <!-- Info boxes -->
        <div class="row ">
            <?php $socialMediaCLicks->getSocials();  ?>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><b>Weekly Statistics</b></h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <article class="mb-2 col-md-6 col-sm-12">
                                <form name='SocialWeeklyChart' method="GET">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-10">
                                            <label>Select Week</label>
                                            <input class="form-control" type='date' name="week" value="<?php echo Date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                </form>
                            </article>
                            <!--<a href="javascript:void(0);">View Report</a>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg"><?php echo $View->getTotalSocialViews() ?> Clicks in total</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="position-relative mb-4">
                            <canvas id="visitors-chart" width="auto" height="500px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-------->
            <?php /* ?><div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Visits</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">18230</span>
                                <span>Visits Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-secondary">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" ></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div> <?php */ ?>
        </div>
        <!--row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><b>Monthly Statistics</b></h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <article class="mb-3">
                                <form name='SocialChart' method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Month</label>
                                            <select class="form-control" name="month">
                                                <?php
                                                for ($m = 1; $m <= 12; $m++) {
                                                    $msel = ($month == $m) ? "selected" : "";
                                                    $formattedMonth = set_date_time('F', $year . '-' . str_pad($m, 2, '0', STR_PAD_LEFT) . '-01');
                                                    echo "<option $msel value='$m'>$formattedMonth</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Year</label>
                                            <select class="form-control" name="year">
                                                <?php
                                                $att = new dbase;
                                                $att->query("SELECT YEAR(Date) as years FROM View_Social_Stats WHERE UniqueID = '" . $getUser . "' GROUP BY years ");
                                                $get_years = $att->fetchMultiple();
                                                foreach ($get_years as $get_year) {
                                                    if ($year == $get_year['years']) {
                                                        $ysel = "selected";
                                                    } else {
                                                        $ysel = "";
                                                    }
                                                    echo "<option $ysel>{$get_year['years']}</option>";
                                                }
                                                $att = NULL;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </article>
                            <a href="?views-chart">View Report</a>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <p class="text-center">
                                    <strong> Social Chart</strong>
                                </p>
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="Socials" width="auto" height="180px"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div id='socialMediaProgressBars'>
                                    <p class="text-center">
                                        <strong><span class="social_Monthly_Totals"><?php echo $View->getTotalMonthlySocialViews() ?></span>
                                            clicks this month</strong>
                                    </p>
                                    <?php 
                                   $labels = $S->getSocialMediaArray($getUser, $month, $year); 
                                    $result =  $S->getSocialMediaCount($getUser, $month, $year); 
                                    
                                    $decodedLabels = json_decode($labels);
                                    $socialForCount = count($decodedLabels);
                                    for ($c = 0; $c < $socialForCount; $c++) { ?>

                                        <div class="progress-group">
                                            <?php echo  $decodedLabels[$c]; ?>
                                            <span class="float-right "><span class="<?php echo strtolower($decodedLabels[$c]) ?>"><?php Click_Month($getUser, strtolower($decodedLabels[$c]), $month, $year); ?></span>/<span class=""><?php Click_view($getUser, strtolower($decodedLabels[$c])); ?></span></span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-<?php echo strtolower($decodedLabels[$c]) ?>" style="width:<?php StatsBar($getUser, strtolower($decodedLabels[$c]), $month, $year); ?>">
                                                </div>
                                            </div>
                                        </div>

                                    <?php  } ?>

                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <?php for ($s = 0; $s < count($decodedLabels); $s++) { ?>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <?php stats($getUser, strtolower($decodedLabels[$s]), $month, $year); ?>
                                        <br>
                                        <span class="description-text"><?php echo $decodedLabels[$s] ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
                <!-- MAP & BOX PANE -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b> Visitor Report</b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-2">
                        <canvas id="Country"></canvas>
                    </div>
                    <div class="card-pane-right bg-light pt-2 pb-2 pl-4 pr-4">
                        <div class="description-block mb-4">
                            <h5 class="description-header"><?php uservisit_counts($getUser) ?></h5>
                            <span class="description-text">Visits</span>
                        </div>
                        <!-- /.description-block -->
                    </div><!-- /.card-pane-right -->
                </div><!-- /.d-md-flex -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="col-md-12">
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><b>Latest Leads</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="example2" class="table m-0 p-2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Where did we meet?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php getLeads($getUser); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="?leads&year=<?php echo $year; ?>" class="btn btn-sm btn-primary float-left">View All</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!--/. container -->
</section>
<!-- /.content -->


<script>
    /*--------------------------progress bar chart---------------------------*/
    function getColorBySocialPlatform(item) {
        let colors = {
            'Tiktok': '#000000',
            'Instagram': '#df1b89',
            'Youtube': '#d42428',
            'Twitter': '#03a9f4',
            'Facebook': '#3b5998',
            'Linkedin': '#007ab9',
            'Whatsapp': '#29a71a',
            'Twitch': '#6340a5',
            'Snapchat': '#ffd633',
            'Telegram': '#039be5',
            'Discord': '#5c6bc0',
            'Pinterest': '#cb2027',
        };

        return colors[item] || '#007bff';
    }

    let label_ = <?php echo $labels ?>;
    let result_ = <?php echo $result ?>;

    const socialChartForm = document.forms.SocialChart;
    const userid = "<?php echo $getUser ?>";

    var foreachMonthlyLoop = label_.map(function(item, i = 0) {
        var color = '#007bff';
        switch (item) {
            case 'Tiktok':
                color = '#000000';
                break;
            case 'Instagram':
                color = '#df1b89';
                break;
            case 'Youtube':
                color = '#d42428';
                break;
            case 'Twitter':
                color = '#03a9f4';
                break;
            case 'Facebook':
                color = '#3b5998';
                break;
            case 'Linkedin':
                color = '#007ab9';
                break;
            case 'Whatsapp':
                color = '#29a71a';
                break;
            case 'Twitch':
                color = '#6340a5';
                break;
            case 'Snapchat':
                color = '#ffd633';
                break;
            case 'Telegram':
                color = '#039be5';
                break;
            case 'Discord':
                color = '#5c6bc0';
                break;
            case 'Pinterest':
                color = '#cb2027';
                break;
            default:
                color = color;
        }
        return color;
    });

    var ctx = document.getElementById('Socials');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label_,
            datasets: [{
                label: ' ',
                data: result_,
                backgroundColor: foreachMonthlyLoop,
                borderColor: foreachMonthlyLoop,
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 0
                    },
                    position: 'bottom',
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false, // This line will remove vertical gridlines
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        // If you want to remove horizontal gridlines as well, set display to false here
                        // display: false,
                    },
                },
            },
        }
    });

   
   const socialMonthlyTotals = document.querySelector(".social_Monthly_Totals");

socialChartForm.addEventListener("change", function(evt) {
    evt.preventDefault();

    if (myChart) {
        myChart.destroy();
    }

    const form_data = new FormData(this);
    form_data.append("userid", userid);

    $.ajax({
        type: "POST",
        url: "includes/ajax/chart/php/social.views.php",
        data: form_data,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
      
            try {
                let data_profile = data;
                result_ = data_profile.result;
                label_ = data_profile.label;

                // Process the color map
                foreachMonthlyLoop = label_.map(item => getColorBySocialPlatform(item));

                // Nested AJAX call for progress bars
                $.ajax({
                    type: "POST",
                    url: "includes/ajax/chart/php/social.views.progressbar.php",
                    data: form_data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(progressbarData) {
                        $("#socialMediaProgressBars").html(progressbarData);

                        // Rebuild the chart
                        let ctx2 = document.getElementById('Socials');

                        myChart = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: label_,
                                datasets: [{
                                    label: '# of Clicks',
                                    data: result_,
                                    backgroundColor: foreachMonthlyLoop,
                                    borderColor: foreachMonthlyLoop,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                    },
                                    y: {
                                        beginAtZero: true
                                    },
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
                    }
                });
            } catch (error) {
                console.error("Failed to parse JSON:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);
        }
    });
});

    /*--------------------------country views---------------------------*/
    const ctx1 = document.getElementById('Country').getContext('2d');
    const Country = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo $R->user_CountryShow($getUser); ?>,
            datasets: [{
                label: ' ',
                data: <?php echo $R->getCountryCount($getUser); ?>,
                backgroundColor: [
                    '#000000c7'
                ],
                borderColor: [
                    '#000000c7'
                ],
                borderWidth: 1
            }, ]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        display: false, // This line will remove vertical gridlines
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        // If you want to remove horizontal gridlines as well, set display to false here
                        // display: false,
                    },
                },
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


<script>
    /*------------------weekly chart--------------------------------------------------*/
    $(document).ready(function() {
        const socialWeeklyChartForm = document.forms.SocialWeeklyChart;

        var daysData = <?php echo $sClick->getSocialClickDays() ?>;
        var loopData = <?php echo $sClick->showSocials(); ?>;
        var loopCount = <?php echo $sClick->getEverything(); ?>;

        var foreachLoop = loopData.map(function(item, i = 0) {
            let color = getColorBySocialPlatform(item);


            return {
                type: 'bar',
                label: item,
                data: loopCount[i],
                backgroundColor: color,
                borderColor: color,
                pointBorderColor: color,
                pointBackgroundColor: color,
                radius: 1,
                fill: false,
                tension: 0.4
            }

        });

        var vChart = document.getElementById('visitors-chart')
        var visitorsChart = new Chart(vChart, {
            data: {
                labels: daysData,
                datasets: foreachLoop
            },
            options: {
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        labels: {
                            boxWidth: 10
                        },
                        position: 'bottom',
                    }
                },


                legend: {
                    display: true
                },
                scales: {
                    x: {
                        grid: {
                            display: false, // This line will remove vertical gridlines
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            // If you want to remove horizontal gridlines as well, set display to false here
                            // display: false,
                        },
                    },
                },
            }
        })

        /*-----refresh weekly clicks function---------*/
        function refreshWeeklyForm(form_data, userid) {
            form_data.append("userid", userid);
            $.ajax({
                type: "POST",
                url: "includes/ajax/chart/php/social.clicks.php",
                data: form_data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    let data_profile = JSON.parse(data);
                    daysData = data_profile.daysData;
                    loopData = data_profile.loopData;
                    loopCount = data_profile.loopCount;
                    foreachLoop = loopData.map(function(item, j = 0) {
                        let color = getColorBySocialPlatform(item);

                        return {
                            type: 'bar',
                            label: item,
                            data: loopCount[j].match(/\w+/g),
                            backgroundColor: color,
                            borderColor: color,
                            pointBorderColor: color,
                            pointBackgroundColor: color,
                            radius: 1,
                            fill: false,
                            tension: 0.4
                        }

                    });

                    vChart = $('#visitors-chart');
                    visitorsChart = new Chart(vChart, {
                        data: {
                            labels: daysData,
                            datasets: foreachLoop
                        },
                        options: {
                            maintainAspectRatio: false,

                            plugins: {
                                legend: {
                                    labels: {
                                        boxWidth: 10
                                    },
                                    position: 'bottom',
                                }
                            },


                            legend: {
                                display: true
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false, // This line will remove vertical gridlines
                                    },
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        // If you want to remove horizontal gridlines as well, set display to false here
                                        // display: false,
                                    },
                                },
                            },
                        }
                    })


                }

            });
        }

        socialWeeklyChartForm.addEventListener("change", function(evt) {
            evt.preventDefault();
            if (visitorsChart) {
                visitorsChart.destroy();
            }
            const form_data = new FormData(this);
            form_data.forEach((value, key) => {});
            refreshWeeklyForm(form_data, userid)

        });

    });
</script>