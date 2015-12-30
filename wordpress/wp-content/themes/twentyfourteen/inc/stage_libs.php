<?php

namespace MEIMEI;

$htmlEncode = "UTF-8";

function getStageDetail($stageId)
{
	// 公演情報取得
	global $wpdb;
	$wpdb->show_errors();
	
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
				. " WHERE s.stage_id = %d AND s.delete_time IS NULL ";
	$param = array();
	$param[] = $stageId;
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
			. " WHERE sm.stage_id = %d AND sm.delete_time IS NULL "
			. " ORDER BY m.sort_order ";
	$query = $wpdb->prepare($query, $param);
	$memberList = $wpdb->get_results($query);
	$result[0]->memberList = $memberList;
	
	// 関連リンクを取得
	$query = " SELECT l.related_link_id "
			. " , l.link "
			. " FROM Related_Link l "
			. " WHERE l.stage_id = %d AND l.delete_time IS NULL "
			. " ORDER BY l.related_link_id ";
	$query = $wpdb->prepare($query, $param);
	$linkList = $wpdb->get_results($query);
	$result[0]->linkList = $linkList;

	return $result;
}

function registerStage($stageDate, $stageTimes, $teamId, $isShuffled, $programId, $members, $links)
{
	foreach ($stageTimes as $stageTime)
	{
		$stageId = str_replace("-", "", $stageDate) . "0" . $stageTime;
		$query = " SELECT 'x' FROM Stage "
			. " WHERE stage_id = %d ";
		$query = $wpdb->prepare($query, $param);
		$isExists = $wpdb->get_results($query);
		if ($isExists == null)
		{
			// 公演の登録
			$results[] = $wpdb->insert(
				'Stage',
				array(
						'stage_id' => $stageId,
						'program_id' => $programId,
						'team_id' => $teamId,
						'stage_date' => $stageDate,
						'stage_time' => $stageTime,
						'is_shuffled' => $isShuffled,
						'regist_time' => date("Y-m-d H:i:s TO")
				),
				array(
						'%d',
						'%d',
						'%d',
						'%s',
						'%d',
						'%d',
						'%s'
				)
			);
		}
		else
		{
			// 公演の登録
			$results[] = $wpdb->update(
				'Stage',
				array(
					'program_id' => $programId,
					'team_id' => $teamId,
					'is_shuffled' => $isShuffled,
					'regist_time' => date("Y-m-d H:i:s TO")
				),
				array(
					'stage_id' => $stageId
				),
				array(
					'%d',
					'%d',
					'%d',
					'%s'
				),
				array(
					'%d',
				)
			);
		}
	}
}