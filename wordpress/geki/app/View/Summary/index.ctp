<?php
echo $this->Html->css( array('summary'), array( 'inline' => false) );
echo $this->Html->script( array('jquery-1.10.2', 'summary'), array( 'inline' => false));
?>
<h3><span class="name"><?php echo $name; ?></span> <span style="color: black; font-weight: normal; font-size: 80%;">さんで閲覧中</span></h3>
<p _style="text-align:right;">&nbsp;最終更新日：<?php echo $lastUpdate /*date("Y/m/d H:i:s", time())*/ ?></span>
<?php if ($isNewUpdate) { ?>
&nbsp;<img src="/geki/img/icon3newpink.gif">
<?php } ?>
</p>
<?php echo $this->element('header-buttons', array('loginLabel' => 'ログアウト', 'listLabel' => '確保状況', 'summaryLabel' => '再読み込み', 'openFlag' => $openFlag)); ?>
<?php if (isset($memberList)) { ?>
<section>
<table>
    <thead>
        <tr>
            <td>user_hash</td>
            <td>revision</td>
        </tr>
    </thead>
    <tbody>
<?php foreach ($datas as $data) { ?>
        <tr>
            <th><?php echo $data['user_hash'] ?></th>
            <th><?php echo $data['revision'] ?></th>
        </tr>
<?php } ?>
    </tbody>
</table>
</section>
<?php } ?>

<section>
<h2>選対票サマリー</h2>
<table>
    <thead>
        <tr>
            <th colspan="2">項目</th>
            <th colspan="2">数量</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">登録人数</td>
            <td class="value_field"><input type="number" id="historyCount" value="<?php echo $historyCount ?>" readonly></td><td>人</td>
        </tr>
        <tr>
            <td colspan="2">劇場盤CD</td>
            <td class="value_field"><input type="number" id="allocatesCount" value="<?php echo $allocatesCount ?>" readonly></td><td>枚</td>
        </tr>
        <tr>
            <td rowspan="3">選対メンバー確保分</td>
            <td>モバイル(人)</td>
            <td class="value_field"><input type="number" id="myAllocatedVotesMobile" value="<?php echo $myAllocatedVotesMobile ?>" readonly></td><td>人分</td>
        </tr>
        <tr>
            <td>モバイル(１人分)</td>
            <td class="value_field"><input type="number" id= "myAllocatedVotesMobileUnit" value="10"></td><td>票</td>
        </tr>
        <tr>
            <td>その他</td>
            <td class="value_field"><input type="number" id="myAllocatedVotesOther" value="<?php echo $myAllocatedVotesOther ?>" readonly></td><td>票</td>
        </tr>
        <tr>
            <td rowspan="3">友人・知人の票</td>
            <td>モバイル(人)</td>
            <td class="value_field"><input type="number" id= "friendsVotesMobile" value="<?php echo $friendsVotesMobile ?>" readonly></td><td>人分</td>
        </tr>
        <tr>
            <td>モバイル(１人分)</td>
            <td class="value_field"><input type="number" id= "friendsVotesMobileUnit" value="5"></td><td>票</td>
        </tr>
        <tr>
            <td>その他</td>
            <td class="value_field"><input type="number" id= "friendsVotesOther" value="<?php echo $friendsVotesOther ?>" readonly></td><td>票</td>
        </tr>
        <tr>
            <td rowspan="3">大量購入用残予算</td>
            <td>予算</td>
            <td class="value_field"><input type="number" id="bulkBudgetsMoney" value="<?php echo $bulkBudgetsMoney ?>" readonly></td><td>円</td>
        </tr>
        <tr>
            <td>平均単価</td>
            <td class="value_field"><input type="number" id="unit" value="800"></td><td>円</td>
        </tr>
        <tr>
            <td>概算票数</td>
            <td class="value_field"><input type="number" id="votesFromBudget" value="" readonly></td><td>票</td>
        </tr>
    </tbody>
</table>
</section>

<section style="text-align:center;">
<label><input type="button" id="calc" value="再計算" style="width: 80%;"></label>
</section>

<section style="font-size: large;">
現在の選対票数： <span id="calcResult"></span> 票
</section>
