<?php

namespace MEIMEI;

$htmlEncode = "UTF-8";
/* 酒井萌衣さんのツイッター・インスタグラムなどのポストを取得するライブラリ */

/* RSSを確認する最短の間隔。1時間 */
$RssIntervalSec = 1 * 60 * 60;

/* RSSのURL */
$RssUrls = array(
	1 => 'https://queryfeed.net/twitter?q=from%3Amei_chan1213&title-type=user-name-both&geocode=',
	2 => 'http://feed.exileed.com/instagram/feed/mei_sakai/'
);
/* 埋め込み情報取得のURL */
$EmbedUrls = array(
	1 => 'https://api.twitter.com/1/statuses/oembed.json?align=center&id=',
	2 => 'https://api.instagram.com/oembed/?hidecaption=0&url='
);

function getMeiPostHtml()
{
	$wHtmls = array();

	// 最新の投稿情報をデータベースから取得する
	$wPostsInfos = getMeiPostsInfo();

	foreach ($wPostsInfos as $wPostsInfo) {
		$wPostType = $wPostsInfo->post_type;

		// 最新の投稿が特定の時間内の場合は、データベースから取得した埋め込みhtmlを返す
		if ((strtotime($wPostsInfo->regist_time) + $RssIntervalSec) < (time() + 60 * 60 * 9)) {
			$wPostsInfos[$wPostType] = [
				'registDate' => strtotime($wPostsInfo->regist_time),
				'html' => $wPostsInfo->html
			];
			continue;
		}

		// RSSをネットから取得し、最新情報を確認する
		$wRssUrl = $RssUrls[$wPostType];
		$wRss = getRss($wRssUrl);
		if ($wRss === FALSE) {
			$wPostsInfos[$wPostType] = [
				'registDate' => strtotime($wPostsInfo->regist_time),
				'html' => $wPostsInfo->html
			];
			continue;
		}

		// RSSから最新の投稿のURLを取得する
		if ($wPostType == 1) {
			$wLinkUrl = '';
			$i = 0;
			while (isset($wRss->{"channel"}->{"item"}->{$i})
				&& isset($wRss->{"channel"}->{"item"}->{$i}->{"link"})) {
				$wLinkUrl = $wRss->{"channel"}->{"item"}->{$i}->{"link"};

				$matches = array();
				$wResult = preg_match('/(\d+)$/', $wLinkUrl, $matches);
				// ID
				echo $matches[1];
			}
		}
		// 最新の投稿のURLをデータベースのものと比較しRSSが更新されていなかった場合は、データベースから取得した埋め込みhtmlを返す
		// RSSが更新されていた場合は、最新の投稿のURLから埋め込みJSONを取得するためのキーを生成する
		//  キー... twitter：URL末尾の数字、instagram：URLそのもの
		// 埋め込みHTMLのためのJSONを取得する
		// JSONからhtmlを取得する
		// 一連の情報をデータベースに保存する
	}
	// HTMLを返す
}

function getRss($pRssUrl)
{
	try {
		$contents = file_get_contents($pRssUrl);
		if ($contents === FALSE) {
			return FALSE;
		}
		$rss = simplexml_load_string($contents);
		return $rss;
	} catch (Exception $e) {
		//print_r($e);
	}

	return FALSE;
}


// 最新の投稿情報を取得する
function getMeiPostsInfo()
{
	global $wpdb;
	$wpdb->show_errors();
	
	$query = " SELECT "
			. "   t.post_link "
			. " , t.html "
			. " , t.regist_time "
			. " , t.post_type "
			. " FROM (SELECT "
			. "   post_link "
			. " , html "
			. " , regist_time "
			. " , post_type "
			. " FROM Meimei_Posts "
			. " WHERE post_type = 1 "
			. " ORDER BY regist_time DESC) t ";
	$query .= " UNION ";
	$query .= " SELECT "
			. "   t.post_link "
			. " , t.html "
			. " , t.regist_time "
			. " , t.post_type "
			. " FROM (SELECT "
			. "   post_link "
			. " , html "
			. " , regist_time "
			. " , post_type "
			. " FROM Meimei_Posts "
			. " WHERE post_type = 2 "
			. " ORDER BY regist_time DESC) t ";
//	$param = array();
//	$query = $wpdb->prepare($query, $param);
	$rows = $wpdb->get_results($query);

	$wPostsInfos = array();
	$wPostsInfos[1] = (object) array(
		'post_link' => '',
		'html' => '',
		'regist_time' => '',
		'post_type' => 0
	);
	$wPostsInfos[2] = (object) array(
		'post_link' => '',
		'html' => '',
		'regist_time' => '',
		'post_type' => 0
	);
	if ($rows != null)
	{
		foreach ($rows as $row)
		{
			$wPostType = $row->post_type;
			echo '$wPostType=(' . $wPostType . ')';
			$wPostsInfos[$wPostType]->post_link   = $row->post_link;
			$wPostsInfos[$wPostType]->html        = $row->html;
			$wPostsInfos[$wPostType]->regist_time = $row->regist_time;
			$wPostsInfos[$wPostType]->post_type   = $row->post_type;
		}
	}

	return $wPostsInfos;
}
