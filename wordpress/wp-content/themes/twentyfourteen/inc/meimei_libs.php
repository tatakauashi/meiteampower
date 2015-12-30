<?php

namespace MEIMEI;

$htmlEncode = "UTF-8";
/*
$processEncode = "UTF-8";
$isFeaturePhone = false;

function setupHtmlEncode()
{
	global $htmlEncode, $isFeaturePhone;
	if (isset($_REQUEST["meimei_htmlEncode"]) && $_REQUEST["meimei_htmlEncode"] == "1") {
		$htmlEncode = "SJIS"; //"Shift_JIS";
	}
	if (isset($_REQUEST["meimei_featurePhone"])) {
		$isFeaturePhone = true;
	}
}
*/

$PHP_PRINT_VALUE = array();

function escapeHtml($val)
{
	$val = str_replace('&', '&amp;', $val);
	$val = str_replace('\"', '&quot;', $val);
	$val = str_replace('"', '&quot;', $val);
	$val = str_replace("\\'", '&apos;', $val);
	$val = str_replace('\'', '&apos;', $val);
	$val = str_replace('<', '&lt;', $val);
	$val = str_replace('>', '&gt;', $val);

/*	$val = str_replace("\r\n", '<br>', $val);
	$val = str_replace("\n", '<br>', $val);
	$val = str_replace("\r", '<br>', $val);*/
	return $val;
}

function setPrintValue($name, $val, $isEscapeHtml = true)
{
	global $PHP_PRINT_VALUE; //, $htmlEncode, $processEncode;
	//$val = mb_convert_encoding($val, $processEncode, $htmlEncode);
	if ($isEscapeHtml) {
//		$val = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5);
		$val = escapeHtml($val);
	}
	$PHP_PRINT_VALUE[$name] = $val;
}

function setPV($name, $val, $isEscapeHtml = true)
{
	setPrintValue($name, $val, $isEscapeHtml);
}

function getPrintValue($name)
{
	global $PHP_PRINT_VALUE; //, $htmlEncode, $processEncode;
	if (isset($PHP_PRINT_VALUE[$name])) {
		return $PHP_PRINT_VALUE[$name]; // mb_convert_encoding($PHP_PRINT_VALUE[$name], $processEncode, $htmlEncode);
	} else {
		return "";
	}
//	return isset($PHP_PRINT_VALUE[$name]) ? $PHP_PRINT_VALUE[$name] : "";
}

function getPV($name)
{
	return getPrintValue($name);
}


$PHP_ERROR_MESSAGE = array();

function setErrorMessage($name, $val)
{
	global $PHP_ERROR_MESSAGE;
	//$val = mb_convert_encoding($val, $processEncode, $htmlEncode);
	$PHP_ERROR_MESSAGE[$name] = $val;
}

function setErrMsg($name, $val)
{
	setErrorMessage($name, $val);
}

function getErrorMessage($name, $openTags = "", $closeTags = "")
{
	global $PHP_ERROR_MESSAGE; //, $htmlEncode, $processEncode;
	if (isset($PHP_ERROR_MESSAGE[$name])) {
//		return $openTags . mb_convert_encoding($PHP_ERROR_MESSAGE[$name], $processEncode, $htmlEncode) . $closeTags;
		return $openTags . $PHP_ERROR_MESSAGE[$name] . $closeTags;
	}
	else {
		return "";
	}
}

function getErrMsg($name, $openTags = "", $closeTags = "")
{
	return getErrorMessage($name, $openTags, $closeTags);
}


$XML_MESSAGE = array();
$isXmlLoaded = false;

function loadXML($lang)
{
	global $XML_MESSAGE, $isXmlLoaded, $htmlEncode, $processEncode;
	if ($isXmlLoaded) {
		return;
	}

	$xmlFile = "wp-content/themes/twentyfourteen/resources/Messages_" . $lang . ".xml";
	if (!file_exists($xmlFile)) {
//		echo "file $xmlFile does not exits.<br> Current Working Directory is " . getcwd();
		return;
	}
	$xmlData = simplexml_load_file($xmlFile);
	foreach ($xmlData->Normal->Param as $data) {
		$XML_MESSAGE["$data->Name"] = $data->Value;
	}
	foreach ($xmlData->Error->Param as $data) {
		$XML_MESSAGE["$data->Name"] = $data->Value;
	}
	$isXmlLoaded = true;
}

function getXmlMsg($name)
{
	global $XML_MESSAGE, $isXmlLoaded; //, $processEncode, $htmlEncode;
	if ($isXmlLoaded) {
		//$val = mb_convert_encoding($XML_MESSAGE[$name], $processEncode, $htmlEncode);
		return $XML_MESSAGE[$name];
	}
	else {
		return "";
	}
}

$INPUT_VALUE = array();

function readInputValues($names)
{
	global $INPUT_VALUE;
//	global $htmlEncode;
//	global $processEncode;
	foreach ($names as $name) {
		$postName = "meimei." . $name;
		if (isset($_POST[$postName])) {
			$INPUT_VALUE[$name] = $_POST[$postName]; //mb_convert_encoding($_POST[$postName], $htmlEncode, $processEncode);
		} else {
			$INPUT_VALUE[$name] = "";
		}
	}
}
