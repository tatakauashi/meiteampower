<?php

namespace MEIMEI;

$htmlEncode = "UTF-8";

function getStageDetail($stageId)
{
	// 公演情報取得
	global $wpdb;
	$wpdb->show_errors();
	$revision = getCurrentRevision($stageId);

	$query =  " SELECT s.stage_id "
				. " , s.program_id "
				. " , s.team_id "
				. " , s.stage_date "
				. " , s.stage_time "
				. " , s.is_shuffled + 0 AS is_shuffled "
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
	if ($result == null)
	{
		return null;
	}

	// 参加メンバーを取得
	$query = " SELECT m.member_id "
			. " , m.member_name "
			. " FROM Stage_Member sm "
			. " JOIN Member m ON (sm.member_id = m.member_id) "
			. " WHERE sm.stage_id = %d AND sm.revision = %d "
			. " ORDER BY m.sort_order ";
	$query = $wpdb->prepare($query, $param);
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
			. " , em.member_id "
			. " FROM Stage_Event se "
			. " LEFT JOIN Stage_Event_Member em ON (se.stage_id = em.stage_id AND se.revision = em.revision) "
			. " LEFT JOIN Member m ON (em.member_id = m.member_id) "
			. " WHERE se.stage_id = %d AND se.revision = %d "
			. " ORDER BY se.event_id, m.sort_order ";
	$query = $wpdb->prepare($query, $param);
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
function registerStage($stageDate, $stageTimes, $teamId, $isShuffled,
		$programId, $memberIds, $links, $eventIds, $eventMemberIds, $stageComment)
{
	global $wpdb;
	$wpdb->show_errors();

	$userLogin = wp_get_current_user()->user_login;

	$stageId = 0;
	$results = array();
	$wpdb->query('START TRANSACTION');
	foreach ($stageTimes as $stageTime)
	{
		$stageId = getStageId($stageDate, $stageTime);
		$revision = getCurrentRevision($stageId) + 1;

		// 公演の登録
		$results[] = $wpdb->insert(
			'Stage',
			array(
				'stage_id' => $stageId,
				'revision' => $revision,
				'program_id' => $programId,
				'team_id' => $teamId,
				'stage_date' => $stageDate,
				'stage_time' => $stageTime,
				'is_shuffled' => $isShuffled,
				'regist_time' => date("Y-m-d H:i:s TO"),
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
				'%s',
				'%s'
			)
		);
		
		// 出演メンバー
		foreach ($memberIds as $memberId)
		{
			$results[] = $wpdb->insert(
				'Stage_Member',
				array(
					'stage_id' => $stageId,
					'member_id' => $memberId,
					'revision' => $revision,
					'regist_time' => date("Y-m-d H:i:s TO"),
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
		foreach ($links as $link)
		{
			$results[] = $wpdb->insert(
				'Related_Link',
				array(
					'stage_id' => $stageId,
					'revision' => $revision,
					'link' => $link,
					'regist_time' => date("Y-m-d H:i:s TO"),
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
		for ($i = 0; $i < count($eventIds); $i++)
		{
			$eventId = $eventIds[$i];
			$memberId = $eventMemberIds[$i];
			$results[] = $wpdb->insert(
				'Stage_Event',
				array(
					'stage_id' => $stageId,
					'event_id' => $eventId,
					'revision' => $revision,
					'regist_time' => date("Y-m-d H:i:s TO"),
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
			
			if ($memberId <= 0) continue;
			$results[] = $wpdb->insert(
				'Stage_Event_Member',
				array(
					'stage_id' => $stageId,
					'event_id' => $eventId,
					'member_id' => $memberId,
					'revision' => $revision,
					'regist_time' => date("Y-m-d H:i:s TO"),
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

		// コメント
		if ($stageComment != "") {
		$results[] = $wpdb->insert(
			'Stage_Comment',
			array(
				'stage_id' => $stageId,
				'branch_no' => 1,
				'revision' => $revision,
				'comment' => $stageComment,
				'regist_time' => date("Y-m-d H:i:s TO"),
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

// 「・」で区切られたメンバー名の文字列から、それぞれのメンバーのIDを配列で取得する。
function getMemberIds($stageMembersString)
{
	global $wpdb;
	$wpdb->show_errors();

	$stageMembersString = str_replace("高寺", "髙寺", $stageMembersString);
	$stageMembersString = str_replace("高塚", "髙塚", $stageMembersString);
	$stageMembers = explode("・", $stageMembersString);
	$stageMembers = array_map('trim', $stageMembers);
	$stageMembers = array_filter($stageMembers, 'strlen');
	$memberIds = array();
	foreach ($stageMembers as $memberName)
	{
		$query = "SELECT member_id FROM Member WHERE member_name = %s ";
		$rows = $wpdb->get_results($wpdb->prepare($query, $memberName));
		if (count($rows) > 0)
		{
			$memberIds[] = $rows[0]->member_id;
		}
	}
	return $memberIds;
}

// メンバー全員のIDと名前を取得する。
function getMembers()
{
	global $wpdb;
	$wpdb->show_errors();

	$query = "SELECT member_id, member_name FROM Member ";
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
	
	$query = " SELECT MAX(revision) AS revision FROM Stage "
			. " WHERE stage_id = %d ";
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