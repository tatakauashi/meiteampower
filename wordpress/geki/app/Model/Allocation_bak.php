<?php
App::uses('AppModel', 'Model');

/*
 * 確保モデル。
 */
class Allocation extends AppModel {

    function get($userHash) {

        // 最新リビジョンの取得
        $sql = 'SELECT MAX(`revision`) AS `revision` from `histories` where `user_hash` = ? group by `user_hash`';
        $datas = $this->query($sql, array($userHash));
        $currentRevision = 0;
        foreach ($datas as $data) {
            $currentRevision = $data['0']['revision'];
        }

        // 画面出力項目の初期化
        $returns = array();
        for ($dateId = 1; $dateId <= 4; $dateId++) {  // 日
            for ($divisionId = 1; $divisionId <= 6; $divisionId++) {  // 部
                for ($memberType = 1; $memberType <= 1; $memberType++) {  // めいめい/他メンバー
                    $returns['meimei' . $dateId . $divisionId . $memberType] = 0;
                    $returns['other' . $dateId . $divisionId . $memberType] = 0;
                }
            }
        }

        // 自分のデータを取得
        $datas = $this->find('all', array('conditions' => array('Allocation.user_hash' => $userHash)));
        foreach ($datas as $data) {
            $returns['you' . $data['Allocation']['date_id'] . $data['Allocation']['division_id'] . $data['Allocation']['draw_id']] = $data['Allocation']['count'];
        }

        if ($openFlag) {
            // 確定分の合計
            $sql = 'SELECT `date_id`, `division_id`, `draw_id`, sum(`count`) as `count` from `allocations` where `fixed` = 1 group by `date_id`, `division_id`, `draw_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sum' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . $data['allocations']['draw_id']] = $data['0']['count'];
            }

            // 未確定分を含めた合計
            $sql = 'SELECT `date_id`, `division_id`, `draw_id`, sum(`count`) as `count`, count(*) as `join` from `allocations` where `count` > 0 group by `date_id`, `division_id`, `draw_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sumAll' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . $data['allocations']['draw_id']] = $data['0']['count'];
                $returns['join' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . $data['allocations']['draw_id']] = $data['0']['join'];
            }
        }

        // 抽選次ごとの合計
        // 自分
        $sql = 'SELECT `draw_id`, sum(`count`) as `count` from `allocations` where `user_hash` = :user_hash group by `draw_id`;';
        $datas = $this->query($sql, array('user_hash' => $userHash));
        foreach ($datas as $data) {
            $returns['you00' . $data['allocations']['draw_id']] = $data['0']['count'];
        }
        // 確定分
        if ($openFlag) {
            $sql = 'SELECT `draw_id`, sum(`count`) as `count` from `allocations` where `fixed` = 1 group by `draw_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sum00' . $data['allocations']['draw_id']] = $data['0']['count'];
            }
            // 未確定を含めた合計
            $sql = 'SELECT `draw_id`, sum(`count`) as `count` from `allocations` group by `draw_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sumAll00' . $data['allocations']['draw_id']] = $data['0']['count'];
            }
            $sql = 'SELECT t.draw_id, count(*) as `join` from (SELECT `draw_id`, count(*) as `join` from `allocations` where `count` > 0 group by `draw_id`, `user_hash`) t group by t.draw_id;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['join00' . $data['t']['draw_id']] = $data['0']['join'];
            }
        }

        // 日・部ごとの合計
        // 自分
        $sql = 'SELECT `date_id`, `division_id`, sum(`count`) as `count` from `allocations` where `user_hash` = :user_hash group by `date_id`, `division_id`;';
        $datas = $this->query($sql, array('user_hash' => $userHash));
        foreach ($datas as $data) {
            $returns['you' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . '0'] = $data['0']['count'];
        }
        if ($openFlag) {
            // 確定分
            $sql = 'SELECT `date_id`, `division_id`, sum(`count`) as `count` from `allocations` where `fixed` = 1 group by `date_id`, `division_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sum' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . '0'] = $data['0']['count'];
            }
            // 未確定を含めた合計
            $sql = 'SELECT `date_id`, `division_id`, sum(`count`) as `count` from `allocations` group by `date_id`, `division_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sumAll' . $data['allocations']['date_id'] . $data['allocations']['division_id'] . '0'] = $data['0']['count'];
            }
            $sql = 'SELECT t.`date_id`, t.`division_id`, count(*) as `join` from (SELECT `date_id`, `division_id`, count(*) as `join` from `allocations` where `count` > 0 group by `date_id`, `division_id`, `user_hash`) t group by t.`date_id`, t.`division_id`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['join' . $data['t']['date_id'] . $data['t']['division_id'] . '0'] = $data['0']['join'];
            }
        }

        // 総計
        // 自分
        $sql = 'SELECT sum(`count`) as `count` from `allocations` where `user_hash` = :user_hash;';
        $datas = $this->query($sql, array('user_hash' => $userHash));
        foreach ($datas as $data) {
            $returns['you000'] = $data['0']['count'];
        }
        if ($openFlag) {
            // 確定分
            $sql = 'SELECT sum(`count`) as `count` from `allocations` where `fixed` = 1;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sum000'] = $data['0']['count'];
            }
            // 未確定を含めた合計
            $sql = 'SELECT sum(`count`) as `count` from `allocations`;';
            $datas = $this->query($sql);
            foreach ($datas as $data) {
                $returns['sumAll000'] = $data['0']['count'];
            }
        }

//        return $this->find('all', array('conditions' => array('Allocation.user_hash' => $userHash)));

        return $returns;
    }

    function existsData($dateId, $divisionId, $drawId, $userHash) {

        return (bool) $this->find('count', array('conditions' => array(
            'Allocation.date_id' => $dateId,
            'Allocation.division_id' => $divisionId,
            'Allocation.draw_id' => $drawId,
            'Allocation.user_hash' => $userHash,
        )));
    }

    function update($data) {

        if (preg_match('/^[0-9]+$/', $data['Allocation']['fixed'] . $data['Allocation']['count']) == 0) {
            return;
        }

        $this->updateAll(
            array('fixed' => $data['Allocation']['fixed'], 'count' => $data['Allocation']['count']),
            array(
                'date_id'     => $data['Allocation']['date_id'],
                'division_id' => $data['Allocation']['division_id'],
                'draw_id'     => $data['Allocation']['draw_id'], 
                'user_hash'   => $data['Allocation']['user_hash']
            )
        );
    }

}
