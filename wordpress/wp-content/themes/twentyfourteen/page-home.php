<?php
/*
Template Name: page-home
*/

namespace MEIMEI;

// 三次販売終了フラグ
$sellingFinished = false;
if (date("YmdHis", time() + 9 * 60 * 60) > '20160725120000' ) {
	$sellingFinished = true;
}

include_once('page-templates/page-home.tpl');
