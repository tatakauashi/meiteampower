<?php
echo $this->Html->css( array('tabs', 'list'), array( 'inline' => false) );
echo $this->Html->script( array('jquery-1.10.2', 'list'), array( 'inline' => false));
?>
<h3><span class="name"><?php echo $name; ?></span> <span style="color: black; font-weight: normal; font-size: 80%;">さんの確保状況</span></h3>
<?php echo $this->element('header-buttons', array('loginLabel' => 'ログアウト', 'listLabel' => '再読み込み', 'summaryLabel' => 'サマリー', 'openFlag' => $openFlag)); ?>
<?php if (!empty($errMsg)) { ?>
<p style="color:red; font-size: larger; font-weight: bold;"><?php echo $errMsg ?></p>
<?php } ?>
<form id="f" method="post" action="/geki/list/register">
<input type="hidden" name="data[currentRevision]" value="<?php echo $currentRevision ?>">

<section id="idGeki">
    <h2>劇場盤CD確保数</h2>
    酒井萌衣さんに投票する枚数のみ記入してください。
    <div class="tab_content">
    	<ul class="tab">
    	    <li class="select">6/12(日)</li>
    	    <li>6/26(日)</li>
    	    <li>8/13(土)</li>
    	    <li>8/14(日)</li>
    	</ul>
<?php for ($dateId = 1; $dateId <= 4; $dateId++) { ?>
<?php if ($dateId == 1) { ?>
        <div>
<?php } else { ?>
        <div class="hide">
<?php } ?>
        	<table>
        		<thead>
        			<tr>
        				<th style="width:60px;">部</th>
        				<th>確保数</th>
        			</tr>
        		</thead>
        		<tbody>
        <?php for ($divisionId = 1; $divisionId <= 6; $divisionId++) { ?>
        			<tr>
        			    <td><?php echo $divisionId ?> 部</td>
        				<td>
        					<span class="count_label">めいめい</span><input type="number" min="0" name="data[Allocation][mei<?php echo $dateId . $divisionId; ?>]" value="<?php echo $alloc['mei' . $dateId . $divisionId] ?>" required="required"> 枚<br>
        					<span class="count_label">他メンバー</span><input type="number" min="0" name="data[Allocation][other<?php echo $dateId . $divisionId; ?>]" value="<?php echo $alloc['other' . $dateId . $divisionId] ?>" required="required"> 枚
        				</td>
        			</tr>
        <?php } ?>
        			<tr>
        			    <td>当日券</td>
        				<td>
        					<span class="count_label">当日券</span><input type="number" min="0" name="data[Allocation][mei<?php echo $dateId . 7; ?>]" value="<?php echo $alloc['mei' . $dateId . 7] ?>" required="required"> 枚<br>
        				</td>
        			</tr>
        		</tbody>
            </table>
        </div>
<?php } ?>
    </div>
    <div style="margin-bottom:0;">
        <table style="margin-bottom:0;">
		    <tbody>
    			<tr>
    			    <td style="width:60px;">写真のみ</td>
    				<td>
    					<input type="number" min="0" name="data[Allocation][mei<?php echo 18; ?>]" value="<?php echo $alloc['mei' . 18] ?>" required="required"> 枚
    				</td>
    			</tr>
    			<tr>
    			    <td style="width:60px; font-weight: bold;">合計</td>
    				<td>
    					<input type="number" id="gekisum" value="" style="background-color:lightgray;" readonly> 枚
    				</td>
    			</tr>
		    </tbody>
    	</table>
	</div>
</section>

<section>
<h2>劇場盤CD以外で自分の確保済みの票</h2>
<label>モバイル・メール票<br>（10票で計算します）：<input type="checkbox" name="data[MyAllocatedVote][mobile]" value="1" <?php echo !empty($myAllocatedVote['mobile']) && $myAllocatedVote['mobile'] > 0 ? "checked" : "" ?>>
</label><br>
<label>その他：<br>
    <input type="number" min="0" name="data[MyAllocatedVote][other]" value="<?php echo $myAllocatedVote['other'] ?>" required="required"> 票
</label>
</section>

<section>
<h2>友人・知人の票</h2>
<label>モバイル・メール票(依頼した人数)：<br>
<input type="number" min="0" name="data[FriendsVote][mobile]" value="<?php echo $friendsVote['mobile'] ?>" required="required"> 人
</label><br>
<label>その他：<br>
    <input type="number" min="0" name="data[FriendsVote][other]" value="<?php echo $friendsVote['other'] ?>" required="required"> 票
</label>
</section>

<section>
<h2>大量購入用残予算</h2>
確保済みの票に使うものは除く。
<label>
    <input type="number" min="0" name="data[BulkBudget][money]" value="<?php echo $bulkBudgets ?>" style="width: 7em;" required="required"> 円
</label>
</section>

<?php if ("2016-06-17 15:00:00" > date("Y-m-d H:i:s", time())) { ?>
<div style="text-align: center;">
    <label><input type="submit" value="登録・更新" style="width: 80%" <?php echo $disabledSubmit ?>></label>
</div>
<?php } ?>
</form>
