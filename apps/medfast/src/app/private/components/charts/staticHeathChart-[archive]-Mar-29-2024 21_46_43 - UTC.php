<?php




 function staticHealthChart($array_var = [], $size = 'col-12 col-md-12 col-lg-12 col-xl-7')
{
    $years = array();
    $health = [
    'datetime' => [
        '2024-03-10T09:00:00.000Z' => [
            'cholesterol' => '80,60',
            'blood_pressure' => '120,80',
            'glucose' => '20',
            'heart_rate' => '60',
            'sleep' => '7,20',
            'temperature' => '36.6',
            'weight' => '240',
            'height' => '180'
        ],
        '2023-03-10T09:00:00.000Z' => [
            'cholesterol' => '70,50',
            'blood_pressure' => '110,70',
            'glucose' => '10',
            'heart_rate' => '50',
            'sleep' => '7,20',
            'temperature' => '36.6',
            'weight' => '240',
            'height' => '180'
        ],
        // Additional years can be added here
    ]
];

    /* --------Loop through the array and extract the year from each datetime property ---- */
    foreach ($health['datetime'] as $year => $vitals) {
    if (!in_array($year, $years)) {
        $years[] = $year; // Add the year to the $years array if it's not already there
    }
}
    /* ---------------- Sort the years array in descending order ---------------- */
    rsort($years);
    /* ------------- Generate the HTML option elements for each year ------------ */
    $optionsHtml = '';
    foreach ($years as $year) {
        $optionsHtml .= "<option>$year</option>";
    }

    /*--get the most recent heart rate--*/

$health_percentage = calculateHealthPercentage($array_var['current_user_info']['vitals']);
   

?>
    <div class="<? echo $size ?>">
        <div class="card">
            <div class="card-body">
                <div class="chart-title patient-visit mb-0">
                    <h4>Static of your Health</h4>
                    <div class="income-value">
                        <p><span class="passive-view">60%</span> vs last month</p>
                    </div>
                    <div class="average-health">
                        <h5><?php echo $health_percentage ?>% <span>Overall Health</span></h5>
                    </div>
                    <div class="form-group mb-0">
                        <select class="form-control select year-select" id="year-select">
                            <?php echo "$optionsHtml"; ?>
                        </select>
                    </div>
                                       <button type="button" class="btn btn-link" onclick="openModal(this)" data-title='Heart Rate' data-inputname='heart' ><i class="fa fa-plus" aria-hidden="true"></i></button> 
                </div>
                <div id="health-chart"></div>
            </div>
        </div>
    </div>
<? }