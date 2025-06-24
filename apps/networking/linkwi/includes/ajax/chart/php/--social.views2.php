<?php
require('../../../../../includes/linkwi.php');
require(LINKWI_CLASSES_PATH . "/social.views.ext.php");
//require(LINKWI_CLASSES_PATH . "/social.counts.ext.php");
require(LINKWI_CLASSES_PATH . "/social.counts.ext2.php");
require(LINKWI_CLASSES_PATH . "/social.click-new2.php");

$G = new SocialCountExt2;
$G->uniqueid = $_POST['userid'];
$G->month = $_POST['month'];
$G->year = $_POST['year'];

$R = new SocialCounts2($_POST['userid'], $_POST['month'], $_POST['year']);

echo json_encode([
  "label" => $G->getSocialMediaArray(),
  "result" => $G->getSocialMediaCount(),
  "colours" => $G->getSocialColors(),
  "socialMonthlyTotals" => array_sum($G->getSocialMediaCount($_POST['userid'], $_POST['month'], $_POST['year'])),
  //"progressBarPercent" => $R->getClickMonthsPercent($_POST['month'], $_POST['year']),
  "progressBarCount" => $G->getSocialMediaCount(),
  "refreshProgressBar" => $G->combineArry()
]);