<?php
function staticHealthChart($array_var = [])
{
        // Step 1: Sort and organize data by year, then by month.
        $sortedYears = [];
        foreach ($array_var as $date => $data) {
                $year = date('Y', strtotime($date));
                $month = date('m', strtotime($date)); // Use 'm' for month number to keep them in order
                if (!isset($sortedYears[$year])) {
                        $sortedYears[$year] = [];
                }
                $percentage = calculateHealthPercentage($data['vitals']);
                $sortedYears[$year][$month][] = $percentage;
        }

        // Step 2: Calculate monthly averages for each year.
        $monthlyAverages = [];
        foreach ($sortedYears as $year => $months) {
                foreach ($months as $month => $percentages) {
                        if (!isset($monthlyAverages[$year])) {
                                $monthlyAverages[$year] = [];
                        }
                        $average = array_sum($percentages) / count($percentages);
                        $monthlyAverages[$year][$month] = $average;
                }
        }

        $currentYear = date('Y'); // Fixed typo here
        $currentYearData = $monthlyAverages[$currentYear] ?? [];
        $currentYearMonths = array_keys($currentYearData);

        $currentYearMonthNames = array_map(function ($monthNum) {
                $dateObj = DateTime::createFromFormat('!m', $monthNum);
                return $dateObj->format('M'); // 'M' for abbreviated month name
        }, $currentYearMonths);

        echo '<script nonce="'.htmlspecialchars($_SESSION['nonce']).'">';
        echo 'let healthData = ' . json_encode(array_values($currentYearData)) . ';';
        echo 'let healthCategories = ' . json_encode($currentYearMonthNames) . ';';
        echo 'let allHealthData = ' . json_encode($monthlyAverages) . ';';
        echo '</script>';



?>

        <div class="col-12 col-md-12 col-lg-12 col-xl-7">
                <div class="card">
                        <div class="card-body">
                                <div class="chart-title patient-visit mb-0">
                                        <h4>Static of your Health</h4>
                                        <div class="income-value">
                                                <p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs last month</p>
                                        </div>
                                        <div class="average-health">
                                                <h5>72bmp <span>Average</span></h5>
                                        </div>
                                        <div class="input-block mb-0">
                                                <select class="form-control select" id="yearSelect">
                                                        <?php foreach (array_keys($monthlyAverages) as $year) : ?>
                                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                        </div>
                                </div>
                                <div id="health-chart"></div>
                        </div>
                </div>
        </div>

<?php



}