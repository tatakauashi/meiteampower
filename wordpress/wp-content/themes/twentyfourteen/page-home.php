<?php
/*
Template Name: page-home
*/

namespace MEIMEI;

// 五次販売開始フラグ
$sellingFinished = true;
$sellingStarted = false;
if (date("YmdHis", time() + 9 * 60 * 60) >= '20160808190000' ) {
	$sellingStarted = true;
}

include_once('page-templates/page-home.tpl');
