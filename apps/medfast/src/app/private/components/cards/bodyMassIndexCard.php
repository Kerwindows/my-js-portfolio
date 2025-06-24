<style>
.weight-bar.progress {
    justify-content: left;
    -webkit-justify-content: left;
}
</style>
<?php
function bodyMassIndexCard($array_var =[]){

$_weight_in_lb = $array_var['current_user_info']['vitals']['weight'];
if(empty($_weight_in_lb)){
$_weight_in_lb = 0;
}
$converted_weight_in_kg = round($_weight_in_lb * 0.45359237,2);  
$height_in_cm = $array_var['current_user_info']['vitals']['height'];
if(empty($height_in_cm)){
$height_in_cm = 1;
}


?>

<div class="col-12 col-md-12 col-lg-12 col-xl-5 d-flex">
        <div class="card">
            <div class="card-body">
                <div class="chart-title patient-visit">
                    <h4>Body Mass index</h4>
                </div>
                <div class="body-mass-blk">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="weight-blk">
                                <div class="center slider">
                                    <div>
                                        <h4><?php echo $converted_weight_in_kg ?></h4>
                                        <span>kg</span>
                                    </div>
                                    <?php
					// Generate 4 divs in total, starting with $converted_weight_in_kg
					for ($i = 1; $i < 3; $i++) {
					    echo "<div>
					            <h4>" . round(($converted_weight_in_kg + ($i * 2)),0) . "</h4>
					            <span>kg</span>
					          </div>";
					}
					?>
					<div>
                                        <h4><?php echo round($converted_weight_in_kg - 2,0) ?></h4>
                                        <span>kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="weight-blk">
                                <div class="center slider">
                                    <div>
                                        <h4><?php echo round($height_in_cm,0) ?></h4>
                                        <span>cm</span>
                                    </div>
                                    <?php
					for ($i = 1; $i < 3; $i++) {
					    echo "<div>
					            <h4>" . round($height_in_cm,0) . "</h4>
					            <span>cm</span>
					          </div>";
					}
					?>
                                    <div>
                                        <h4><?php echo round($height_in_cm,0) - 2 ?></h4>
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php highlightBMICategory($_weight_in_lb, $height_in_cm); ?>
                </div>
            </div>
        </div>
    </div>
 <?php    
    }