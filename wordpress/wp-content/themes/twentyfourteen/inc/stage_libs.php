<?php

namespace MEIMEI;

$htmlEncode = "UTF-8";

function getStageDetail($stageId, $specifiedRevision)
{
	// 公演情報取得
	global $wpdb;
	$wpdb->show_errors();

	$revision = 0;
	if (isset($specifiedRevision) && $specifiedRevision > 0) {
		$revision = $specifiedRevision;
	}
	else {
		$revision = getCurrentRevision($stageId);
	}
	if ($revision <= 0) {
		return null;
	}

	$query =  " SELECT s.stage_id "
				. " , s.revision "
				. " , s.program_id "
				. " , s.team_id "
				. " , s.stage_date "
				. " , s.stage_time "
				. " , s.is_shuffled + 0 AS is_shuffled "
				. " , s.is_unofficial + 0 AS is_unofficial "
				. " , p.program_name "
				. " , t.team_name "
				. " FROM Stage s "
				. " JOIN Program p ON (s.program_id = p.program_id) "
				. " JOIN Team t ON (s.team_id = t.team_id) "
				. " WHERE s.stage_id = %d AND s.revision = %d ";
	$param = array();
	$param[] = $stageId;
	$param[] = $revision;
	$query = $wpdb->prepare($query, $param);
	$result = $wpdb->get_results($query);
	if ($result == null || count($result) <= 0)
	{
		return null;
	}
	$stageDate = $result[0]->stage_date;

	// 参加メンバーを取得
	$query = " SELECT m.member_id "
			. " , m.member_name "
			. " FROM Member m "
			. " JOIN (SELECT sm.member_id FROM Stage_Member sm WHERE sm.stage_id = %d AND sm.revision = %d) sm2 ON (m.member_id = sm2.member_id) "
			. " JOIN (SELECT bl.member_id, bl.team_id FROM Belonging bl WHERE bl.from_date <= %s AND bl.to_date >= %s) bl2 ON (m.member_id = bl2.member_id) "
			. " JOIN Team t ON (bl2.team_id = t.team_id) "
//			. " WHERE sm.stage_id = %d AND sm.revision = %d "
			. " ORDER BY t.sort_order, m.sort_order ";
// 	$stageDate = getStageDate($stageId);
	$paramMember = array();
	$paramMember[] = $stageId;
	$paramMember[] = $revision;
	$paramMember[] = $stageDate;
	$paramMember[] = $stageDate;
	$query = $wpdb->prepare($query, $paramMember);
	$rows = $wpdb->get_results($query);
	$result[0]->memberList = $rows;
	
	// 関連リンクを取得
	$query = " SELECT l.related_link_id "
			. " , l.link "
			. " FROM Related_Link l "
			. " WHERE l.stage_id = %d AND l.revision = %d "
			. " ORDER BY l.related_link_id ";
	$query = $wpdb->prepare($query, $param);
	$rows = $wpdb->get_results($query);
	$result[0]->linkList = $rows;

	// 関連イベントを取得
	$query = " SELECT se.event_id "
			. " , CASE WHEN em.member_id IS NULL THEN 0 ELSE em.member_id END AS member_id "
			. " FROM Stage_Event se "
			. " LEFT JOIN Stage_Event_Member em ON (se.stage_id = em.stage_id AND se.event_id = em.event_id AND se.revision = em.revision) "
			. " LEFT JOIN Member m ON (em.member_id = m.member_id) "
			. " LEFT JOIN (SELECT bl.member_id, bl.team_id FROM Belonging bl WHERE bl.from_date <= %s AND bl.to_date >= %s) bl2 ON (m.member_id = bl2.member_id) "
			. " LEFT JOIN Team tm ON (tm.team_id = bl2.team_id) "
			. " WHERE se.stage_id = %d AND se.revision = %d "
			. " GROUP BY se.event_id, em.member_id "
			. " ORDER BY se.event_id, tm.sort_order, m.sort_order ";
	$paramEvent = array();
	$paramEvent[] = $stageDate;
	$paramEvent[] = $stageDate;
	$paramEvent[] = $stageId;
	$paramEvent[] = $revision;
	$query = $wpdb->prepare($query, $paramEvent);
	$rows = $wpdb->get_results($query);
	$result[0]->eventMemberList = $rows;

	// コメントを取得
	$query = " SELECT sc.comment, sc.regist_time, sc.regist_user "
			. " FROM Stage_Comment sc "
			. " WHERE sc.stage_id = %d AND sc.revision = %d "
			. " ORDER BY sc.branch_no DESC ";
	$query = $wpdb->prepare($query, $param);
	$rows = $wpdb->get_results($query);
	$result[0]->commentList = $rows;
	
	return $result;
}

// 公演情報を登録する。
function registerStage($registerInfo)
{
	global $wpdb;
	$wpdb->show_errors();

	$userLogin = wp_get_current_user()->user_login;
	$nowDateTime = getSqlNowDateTime();

	$stageId = 0;
	$results = array();
	$wpdb->query('START TRANSACTION');
	foreach ($registerInfo->stage_time as $stageTime)
	{
		$stageId = getStageId($registerInfo->stage_date, $stageTime);

		// リビジョンチェック
		$currentRevision = getCurrentRevision($stageId);
		if ($currentRevision != $registerInfo->revision) {
			$results[] = false;
			break;
		}
		$newRevision = $currentRevision + 1;

		// 公演の登録
		$results[] = $wpdb->insert(
			'Stage',
			array(
				'stage_id' => $stageId,
				'revision' => $newRevision,
				'program_id' => $registerInfo->stage_program,
				'team_id' => $registerInfo->stage_team,
				'stage_date' => $registerInfo->stage_date,
				'stage_time' => $stageTime,
				'is_shuffled' => $registerInfo->stage_shuffled,
				'is_unofficial' => $registerInfo->stage_unofficial,
				'regist_time' => $nowDateTime,
				'regist_user' => $userLogin
			),
			array(
				'%d',
				'%d',
				'%d',
				'%d',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s'
			)
		);
		
		// 出演メンバー
		foreach ($registerInfo->stage_members as $memberId)
		{
			$results[] = $wpdb->insert(
				'Stage_Member',
				array(
					'stage_id' => $stageId,
					'member_id' => $memberId,
					'revision' => $newRevision,
					'regist_time' => $nowDateTime,
					'regist_user' => $userLogin
				),
				array(
					'%d',
					'%d',
					'%d',
					'%s',
					'%s'
				)
			);
		}
		
		// リンク
		foreach ($registerInfo->stage_links as $link)
		{
			$results[] = $wpdb->insert(
				'Related_Link',
				array(
					'stage_id' => $stageId,
					'revision' => $newRevision,
					'link' => $link,
					'regist_time' => $nowDateTime,
					'regist_user' => $userLogin
				),
				array(
					'%d',
					'%d',
					'%s',
					'%s',
					'%s'
				)
			);
		};

		// イベント
		$registerd_events = array();
		$registerd_event_members = array();
		foreach ($registerInfo->stage_events as $event)
		{
			$eventId = $event->event_id;
			if (!in_array($eventId, $registerd_events)) {
				$registerd_events[] = $eventId;
	
				$results[] = $wpdb->insert(
					'Stage_Event',
					array(
						'stage_id' => $stageId,
						'event_id' => $eventId,
						'revision' => $newRevision,
						'regist_time' => $nowDateTime,
						'regist_user' => $userLogin
					),
					array(
						'%d',
						'%d',
						'%d',
						'%s',
						'%s'
					)
				);
			}
			
			$memberId = $event->member_id;
			if (!in_array($eventId . "_" . $memberId, $registerd_event_members)) {
				$registerd_event_members[] = $eventId . "_" . $memberId;

				if ($memberId <= 0) continue;
				$results[] = $wpdb->insert(
					'Stage_Event_Member',
					array(
						'stage_id' => $stageId,
						'event_id' => $eventId,
						'member_id' => $memberId,
						'revision' => $newRevision,
						'regist_time' => $nowDateTime,
						'regist_user' => $userLogin
					),
					array(
						'%d',
						'%d',
						'%d',
						'%d',
						'%s',
						'%s'
					)
				);
			}
		}

		// コメント
		if ($registerInfo->stage_comment != "") {
			$results[] = $wpdb->insert(
				'Stage_Comment',
				array(
					'stage_id' => $stageId,
					'branch_no' => 1,
					'revision' => $newRevision,
					'comment' => $registerInfo->stage_comment,
					'regist_time' => $nowDateTime,
					'regist_user' => $userLogin
				),
				array(
					'%d',
					'%d',
					'%d',
					'%s',
					'%s',
					'%s'
				)
			);
		}
	}

	$success = 1;
	foreach ($results as $result)
	{
		$success = $success * $result;
	}
	if ($success > 0)
	{
		$wpdb->query("COMMIT;");
	}
	else
	{
		$wpdb->query("ROLLBACK;");
		$stageId = 0;
	}
	
	return $stageId;
}

function getSimpleStageInfo($condition, $param)
{
	$query =  " SELECT s.stage_id "
			. " , s.program_id "
			. " , s.team_id "
			. " , s.stage_date "
			. " , s.stage_time "
			. " , s.is_shuffled + 0 AS is_shuffled "
			. " , s.is_unofficial + 0 AS is_unofficial "
			. " , p.program_name "
			. " , t.team_name "
			. " FROM Stage_View s "
			. " JOIN Program p ON (s.program_id = p.program_id) "
			. " JOIN Team t ON (s.team_id = t.team_id) "
			. $condition;

	global $wpdb;
	$wpdb->show_errors();
	$query = $wpdb->prepare($query, $param);
	$result = $wpdb->get_results($query);
	if ($result == null || count($result) <= 0)
	{
		return null;
	}
	return $result[0];
}

function getPreviousStage($stageId, $stageDate)
{
	$condition = " ";
	$param = array();
	if ($stageId > 0)
	{
		$condition .= " WHERE s.stage_id < %d ";
		$param[] = $stageId;
	}
	else {
		$condition .= " WHERE s.stage_date < %s ";
		$param[] = $stageDate;
	}
	$condition .= " ORDER BY s.stage_id DESC LIMIT 1 ";

	return getSimpleStageInfo($condition, $param);
}

function getNextStage($stageId, $stageDate)
{
	$condition = " ";
	$param = array();
	if ($stageId > 0)
	{
		$condition .= " WHERE s.stage_id > %d ";
		$param[] = $stageId;
	}
	else {
		$condition .= " WHERE s.stage_date > %s ";
		$param[] = $stageDate;
	}
	$condition .= " ORDER BY s.stage_id LIMIT 1 ";

	return getSimpleStageInfo($condition, $param);
}

// 「・」で区切られたメンバー名の文字列から、それぞれのメンバーのIDを配列で取得する。
function getMemberIds($stageMembersString)
{
	global $wpdb;
	$wpdb->show_errors();

	$stageMembersString = str_replace("高寺", "髙寺", $stageMembersString);
	$stageMembersString = str_replace("高塚", "髙塚", $stageMembersString);
	$stageMembersString = str_replace("高畑", "髙畑", $stageMembersString);
	$stageMembersString = str_replace("木崎ゆりあ", "木﨑ゆりあ", $stageMembersString);
	$stageMembersString = str_replace("、", "・", $stageMembersString);
	$stageMembers = explode("・", $stageMembersString);
	$stageMembers = array_map('trim', $stageMembers);
	$stageMembers = array_filter($stageMembers, 'strlen');
	$memberIds = array();
	if (count($stageMembers) > 0) {
		$sqlInString = "'" . implode("','", $stageMembers) . "'";
		$query = "SELECT member_id FROM Member WHERE member_name IN ($sqlInString) ";
		$rows = $wpdb->get_results($query);
		foreach ($rows as $row)
		{
			$memberIds[] = $row->member_id;
		}
	}
	return $memberIds;
}

// メンバーIDのリストからメンバー名のリストを取得する。
function getMemberNameList($memberIdList)
{
	global $wpdb;
	$wpdb->show_errors();

	$inElements = array();
	foreach ($memberIdList as $memberId) {
		if (is_numeric($memberId)) {
			$inElements[] = $memberId;
		}
	}
	$memberIdsString = implode(",", $inElements);
	$query = "SELECT member_name FROM Member WHERE member_id IN ($memberIdsString) ORDER BY sort_order ";
	$rows = $wpdb->get_results($query);
	$memberNameList = array();
	if (count($rows) > 0)
	{
		foreach ($rows as $row) {
			$memberNameList[] = $row->member_name;
		}
	}

	return $memberNameList;
}

// 演目IDのリストから演目名（公演名）のリストを取得する。
function getProgramNameList($programIdList)
{
	global $wpdb;
	$wpdb->show_errors();

	$programIdsString = implode(",", $programIdList);
	$query = "SELECT program_name FROM Program WHERE program_id IN ($programIdsString) ORDER BY program_id ";
	$rows = $wpdb->get_results($query);
	$programNameList = array();
	if (count($rows) > 0)
	{
		foreach ($rows as $row) {
			$programNameList[] = $row->program_name;
		}
	}

	return $programNameList;
}

// イベントIDのリストからイベント名のリストを取得する。
function getEventNameList($eventIdList)
{
	global $wpdb;
	$wpdb->show_errors();

	$eventIdsString = implode(",", $eventIdList);
	$query = "SELECT event_name FROM Event WHERE event_id IN ($eventIdsString) ORDER BY event_id ";
	$rows = $wpdb->get_results($query);
	$eventNameList = array();
	if (count($rows) > 0)
	{
		foreach ($rows as $row) {
			$eventNameList[] = $row->event_name;
		}
	}

	return $eventNameList;
}

// メンバー全員のIDと名前を取得する。
function getMembers($specificialDate = null)
{
	if ($specificialDate == null) {
		$specificialDate = getSqlNowDate();
	}
	global $wpdb;
	$wpdb->show_errors();

// 	$query = "SELECT member_id, member_name FROM Member ORDER BY sort_order ";
// 	$rows = $wpdb->get_results($query);
	$query = "SELECT m.member_id, m.member_name FROM Member m "
			. " JOIN (SELECT bl.member_id, bl.team_id FROM Belonging bl WHERE bl.from_date <= %s AND bl.to_date >= %s) bl2 "
					. " ON (bl2.member_id = m.member_id) "
			. " JOIN Team t ON (t.team_id = bl2.team_id) "
			. " ORDER BY t.sort_order, m.sort_order ";
	$param = array();
	$param[] = $specificialDate;
	$param[] = $specificialDate;
	$query = $wpdb->prepare($query, $param);
	$rows = $wpdb->get_results($query);
	return $rows;
}

// 演目のIDと名前を取得する。
function getPrograms()
{
	global $wpdb;
	$wpdb->show_errors();

	$query = "SELECT program_id, program_name FROM Program ";
	$rows = $wpdb->get_results($query);
	return $rows;
}

// イベントのIDと名前を取得する。
function getEvents()
{
	global $wpdb;
	$wpdb->show_errors();

	$query = "SELECT event_id, event_name FROM Event ";
	$rows = $wpdb->get_results($query);
	return $rows;
}

// 公演IDを取得する。
function getStageId($stageDate, $stageTime)
{
	return intval(str_replace("-", "", $stageDate) . "0" . $stageTime);
}


// ステージIDに対応する最新のリビジョンを取得する。存在しない場合は0を返す。
function getCurrentRevision($stageId)
{
	global $wpdb;
	$wpdb->show_errors();
	
	$query = " SELECT s.stage_id, s.revision, s.delete_time FROM Stage s "
			. " JOIN (SELECT s2.stage_id, MAX(s2.revision) AS revision FROM Stage s2 "
			. "   GROUP BY s2.stage_id) s3 "
			. "   ON (s.stage_id = s3.stage_id AND s.revision = s3.revision) "
			. " WHERE s.stage_id = %d AND s.delete_time IS NULL ";
	$param = array();
	$param[] = $stageId;
	$query = $wpdb->prepare($query, $param);
	$rows = $wpdb->get_results($query);
	$revision = 0;
	if ($rows != null)
	{
		$revision = $rows[0]->revision;
	}
	return $revision;
}

// SQL用に現在時刻（日本時間）を取得する。
function getSqlNowDateTime()
{
// 	return date("Y-m-d H:i:s TO", time() + 9 * 60 * 60);
 	return date("Y-m-d H:i:s", time() + 9 * 60 * 60);
//	return date("Y-m-d 00:00:00", time() + 9 * 60 * 60);
}

// SQL用に現在日（日本時間）を取得する。
function getSqlNowDate()
{
	return date("Y-m-d", time() + 9 * 60 * 60);
}

// 公演IDから公演日を取得する。その日の何回目の公演かという情報は落ちる。
function getStageDate($stageId)
{
	$s = "" . $stageId;
	return substr($s, 0, 4) . "-" . substr($s, 4, 2) . "-" . substr($s, 6, 2);
}