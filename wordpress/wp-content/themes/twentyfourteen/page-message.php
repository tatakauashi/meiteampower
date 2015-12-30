<?php
/*
Template Name: message
*/

namespace MEIMEI;

session_set_cookie_params( mktime(23, 59, 59, 12, 31, 2015) - time() );
session_start();
setcookie( session_name(), session_id(), mktime(23, 59, 59, 12, 31, 2015) );

include('inc/meimei_libs.php');

//setupHtmlEncode();
//readInputValues(["hoge", "bar"]);

$url = get_permalink();
$check = false;
$meimei_name = "";
$meimei_messageColor = null;
$meimei_lang = 0;
$meimei_message = "";
$lang = "ja";

if (isset($_POST["meimei_lang"])) {

	if (isset($_POST["meimei_lang_jp"])) {
		$meimei_lang = 0;
		$lang = "ja";
		setPV("meimei_lang_jp_selected", "lang_selected");
		setPV("meimei_lang", "0");
	} else if (isset($_POST["meimei_lang_en"])) {
		$meimei_lang = 1;
		$lang = "en";
		setPV("meimei_lang_en_selected", "lang_selected");
		setPV("meimei_lang", "1");
	} else if (isset($_POST["meimei_lang_zh"])) {
		$meimei_lang = 2;
		$lang = "zh";
		setPV("meimei_lang_zh_selected", "lang_selected");
		setPV("meimei_lang", "2");
	} else {
		if ($_POST["meimei_lang"] == "1") {
			$meimei_lang = 1;
			$lang = "en";
			setPV("meimei_lang_en_selected", "lang_selected");
			setPV("meimei_lang", "1");
		} else if ($_POST["meimei_lang"] == "2") {
			$meimei_lang = 2;
			$lang = "zh";
			setPV("meimei_lang_zh_selected", "lang_selected");
			setPV("meimei_lang", "2");
		} else {
			$meimei_lang = 0;
			setPV("meimei_lang_jp_selected", "lang_selected");
			setPV("meimei_lang", "0");
		}
	}
	loadXml($lang);

	$check = true;

	if (isset($_POST["meimei_lang_jp"]) || isset($_POST["meimei_lang_en"])
			|| isset($_POST["meimei_lang_zh"]) || isset($_POST["meimei_lang_hide"])) {
		$check = false;

		setPV("meimei_name", isset($_POST["meimei_name"]) ? $_POST["meimei_name"] : "");
		setPV("meimei_checked_messageColor_" . (isset($_POST["meimei_messageColor"]) ? $_POST["meimei_messageColor"] : ""), " selected");
		setPV("meimei_message", isset($_POST["meimei_message"]) ? $_POST["meimei_message"] : "");
	}
	else {

		// 入力チェックを行う
		// なまえ
		if (!isset($_POST["meimei_name"])) {
			$check = false;
		} else {
			$meimei_name = $_POST["meimei_name"];
			if ($meimei_name == "") {
				$check = false;
				setErrMsg("error_meimei_name", getXmlMsg("meimei_error_meimei_name_is_empty"));
			}
			else if (mb_strlen($meimei_name) > 40) {
				$check = false;
				setErrMsg("error_meimei_name", getXmlMsg("meimei_error_meimei_name_is_too_long"));
				setPV("meimei_name", $meimei_name);
			}
			else {
				setPV("meimei_name", $meimei_name);
			}
		}

		// ペンの色
		if (!isset($_POST["meimei_messageColor"])) {
			$check = false;
		} else {
			$meimei_messageColor = $_POST["meimei_messageColor"];
			if (!ctype_digit($meimei_messageColor)) {
				$check = false;
			} else {
				$meimei_messageColor += 0;
				if ($meimei_messageColor < 0 || $meimei_messageColor > 8) {
					$ret = false;
				}
				else {
					setPV("meimei_checked_messageColor_" . $meimei_messageColor, " selected");
				}
			}
		}

	/*	// 言語
		if (!isset($_POST["meimei_lang"])) {
			$check = false;
		} else {
			$meimei_lang = $_POST["meimei_lang"];
			if (!ctype_digit($meimei_lang)) {
				$check = false;
			} else {
				$meimei_lang += 0;
				if ($meimei_lang < 0 || $meimei_lang > 2) {
					$ret = false;
				}
			}
		}*/

		// メッセージ
		if (!isset($_POST["meimei_message"])) {
			$check = false;
		} else {
			$meimei_message = $_POST["meimei_message"];
			if ($meimei_message == "") {
				setErrMsg("error_meimei_message", getXmlMsg("meimei_error_meimei_message_is_empty"));
				$check = false;
			}
			else if (mb_strlen($meimei_message) > 80) {
				setErrMsg("error_meimei_message", getXmlMsg("meimei_error_meimei_message_is_too_long"));
				$check = false;
				setPV("meimei_message", $meimei_message);
			}
			else {
				setPV("meimei_message", $meimei_message);
			}
		}
	}
} else {
	setPV("meimei_lang_jp_selected", "lang_selected");
	setPV("meimei_lang", "0");
}

// チェックがOKの場合は登録処理を行う。
$results = "";
if ($check) {

	// 登録処理
/*	$ret = true;
	global $wpdb;
//	$wpdb->show_errors();
	array_push($wpdb->tables, 'meimei_message');
//	$sql = $wpdb->prepare("SELECT name, message FROM meimei_message");
	$sql = "SELECT name, message FROM meimei_message";
	$rows = $wpdb->get_results($sql);
	$results = "<p>データが見つかりませんでした。</p>";
	if ($rows) {
		$results = "";
		foreach ($rows as $row) {
			$results .= "<p>" . $row->name . " さんからのメッセージ " . $row->message . "</p>\n";
		}
	}*/

	// JavaScriptが使えるかどうか
	$isJsOk = 2;
	if (isset($_POST["meimei_load"])) {
		$isJsOk = $_POST["meimei_load"];
		if ($isJsOk != "1" && $isJsOk != "0") {
			$isJsOk = 2;
		}
	}

	//date_default_timezone_set('JST');
	$ret = $wpdb->insert(
		'meimei_message',
		array(
			'session_id' => $_COOKIE['PHPSESSID'],
			'internet_id' => $_SERVER['REMOTE_ADDR'],
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'is_js_ok' => $isJsOk,
			'name' => $meimei_name,
			'pen_color' => $meimei_messageColor,
			'message' => $meimei_message,
			'view_language' => $meimei_lang,
			'write_language' => 'japanese',
			'regist_date' => date("Y-m-d H:i:s TO")
		),
		array(
			'%s',	// session_id
			'%s',	// internet_id
			'%s',	// user_agent
			'%d',	// is_js_ok
			'%s',	// name
			'%d',	// pen_color
			'%s',	// message
			'%d',	// view_language
			'%s',	// write_language
			'%s'	// regist_date
		)
	);
	$_SESSION[ 'insert_id' ] = $wpdb->insert_id;
	
	// 登録結果が成功の場合はサンクス画面を表示
	if ($ret) {
		$lng = '';
		if ($lang == 'en') {
			$lng = '?meimei_l=1';
		} else if ($lang == 'zh') {
			$lng = '?meimei_l=2';
		}
		header("Location: $url/thanks" . $lng);
		exit;
	} else {
		// 失敗した場合はメンテナンス中画面か？
		setErrMsg("error_system_error", getXmlMsg("meimei_error_system_error"));
	}
}


if (isset($_POST["meimei_lang_hide"])) {
	setPV("meimei_lang_hidden", "1");
	setPV("meimei_floatbox", "none");
} else if (isset($_POST["meimei_lang_hidden"]) && $_POST["meimei_lang_hidden"] == "1") {
	setPV("meimei_lang_hidden", "1");
	setPV("meimei_floatbox", "none");
} else if (isset($_POST["meimei_lang_hidden"]) && $_POST["meimei_lang_hidden"] == "0") {
	setPV("meimei_lang_hidden", "0");
	setPV("meimei_floatbox", "block");
} else if (isset($_REQUEST["lang"]) && $_REQUEST["lang"] == "on") {
	setPV("meimei_lang_hidden", "0");
	setPV("meimei_floatbox", "block");
} else {
	// デフォルト表示
//	setPV("meimei_lang_hidden", "1");
//	setPV("meimei_floatbox", "none");
	setPV("meimei_lang_hidden", "0");
	setPV("meimei_floatbox", "block");
}

// メッセージ読み込み
loadXML($lang);
setPV("meimei_lang_class", $lang);

/*
if ($isFeaturePhone) {
	header("Content-type: text/html; charset=Shift_JIS");
	include('page-templates/page-message-input-mobile.tpl');
} else {
	include('page-templates/page-message-input.tpl');
}*/
include('page-templates/page-message-input.tpl');
