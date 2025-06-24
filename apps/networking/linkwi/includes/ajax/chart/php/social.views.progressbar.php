<?php

require('../../../../../includes/linkwi.php');
require(LINKWI_CLASSES_PATH . "/social.views.ext.php");
require(LINKWI_CLASSES_PATH . "/social.counts.ext.php");
include(LINKWI_FUNCTIONS_PATH . "/onclick.php");
$postUserID = $_POST['userid'];
$G = new SocialCountExt;
$P = new SocialViewsExt($postUserID, $_POST['month'], $_POST['year']);

$labels = $G->getSocialMediaArray($postUserID, $_POST['month'], $_POST['year']);
$socialMonthlyTotals = array_sum($G->getSocialMediaCount($postUserID, $_POST['month'], $_POST['year']));
$decodedLabels = $labels;
$socialForCount = count($decodedLabels);
?>
<p class="text-center">
                                    <strong><span class="social_Monthly_Totals"><?php echo $socialMonthlyTotals ?></span>
                                        clicks this month</strong>
                                </p>
                                <?php
                              for($c = 0;$c < $socialForCount;$c++){ ?>
                              
                              <div class="progress-group">
                                  <?php echo  $decodedLabels[$c]; ?>
                                    <span class="float-right"><span class="<?php echo $P->getSocialCount($decodedLabels[$c]); ?>"><?php Click_Month($postUserID, strtolower($decodedLabels[$c]), $_POST['month'], $_POST['year']); ?></span>/<span class=""><?php Click_view($postUserID, strtolower($decodedLabels[$c])); ?></span></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-<?php echo strtolower($decodedLabels[$c]) ?>" style="width:<?php StatsBar($postUserID, strtolower($decodedLabels[$c]), $_POST['month'], $_POST['year']); ?>">
                                        </div>
                                    </div>
                                </div>
                              
                         <?php  } ?>