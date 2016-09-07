<h2><?php echo $name; ?> <span style="color: black; font-weight: normal; font-size: 80%;">さんの確保状況</span></h2>
<?php echo $this->Html->link($this->Html->image('logout.png', array('width' => '88', 'height' => '21')), array('controller' => 'login', 'action' => 'index'), array('escape' => false)); ?>　　
<?php echo $this->Html->link($this->Html->image('reload.png', array('width' => '88', 'height' => '21')), array('controller' => 'list',  'action' => 'index'), array('escape' => false)); ?>
<?php if (!$data['openFlag']) { ?>
<p style="color:red;">登録者数が十分でないため、他の登録者の確保数は表示していません。</p>
<?php } ?>
<section>
    <style>
    table tr th span.txNormal {
        font-weight: normal;
    }
<?php if (!empty($cellDrawId)) { ?>
    table tr th.cellDrawId<?php echo $cellDrawId; ?>,
    table tr td.cellDrawId<?php echo $cellDrawId; ?> {
        background-color: gold;
<?php } ?>
    }
    </style>
	<form id="f" method="post" action="/geki/list/order">
	<input type="hidden" id="action" name="data[action]" value="">
	<input type="hidden" id="drawId" name="data[drawId]" value="">
	<script>
	function save(action, drawId) {
		document.getElementById('action').value = action;
		document.getElementById('drawId').value = drawId;
		document.getElementById('f').submit();
	}
	</script>
	<table>
		<colgroup>
			<col class="rowTitle" span="2">
			<col class="rowData" span="8">
			<col class="rowSummary">
		</colgroup>
		<thead>
			<tr>
				<th rowspan="3">日</th>
				<th rowspan="3">部</th>
				<th class="cellDrawId1">1次<br><span class="txNormal">～3/27(金)</span></th>
				<th class="cellDrawId2">2次<br><span class="txNormal">～3/30(月)</span></th>
				<th class="cellDrawId3">3次<br><span class="txNormal">～4/02(木)</span></th>
				<th class="cellDrawId4">4次<br><span class="txNormal">～4/06(月)</span></th>
				<th class="cellDrawId5">5次<br><span class="txNormal">～4/08(水)</span></th>
				<th class="cellDrawId6">6次<br><span class="txNormal">～4/10(金)</span></th>
				<th class="cellDrawId7">7次<br><span class="txNormal">～4/13(月)</span></th>
				<th class="cellDrawId8">8次<br><span class="txNormal">～4/15(水)</span></th>
				<th>合計</th>
			</tr>
			<tr>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <?php echo $data['you00' . $drawId] ?> 枚<br>
					計 <?php echo $data['sum00' . $drawId] ?> (<?php echo $data['sumAll00' . $drawId] ?>) 枚<br>
					(<?php echo $data['join00' . $drawId] ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you000'] ?> 枚<br>
					計 <?php echo $data['sum000'] ?> (<?php echo $data['sumAll000'] ?>) 枚<br>
					(<?php echo $data['join000'] ?> 人)
				</td>
			</tr>
			<tr>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
                    <?php echo $this->Html->link($this->Html->image('order.png', array('width' => '59', 'height' => '21')), '#', array('escape' => false, 'onclick' => "save('order', '" . $drawId ."');")); ?><br><br>
                    <?php echo $this->Html->link($this->Html->image('fix.png',   array('width' => '59', 'height' => '21')), '#', array('escape' => false, 'onclick' => "save('fix',   '" . $drawId ."');")); ?>
				</td>
<?php } ?>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>

<?php for ($divisionId = 1; $divisionId <= 6; $divisionId++) { ?>
			<tr>
<?php if ($divisionId == 1) { ?>
				<td rowspan="6">8/7(金)</td>
<?php } ?>
<?php switch ($divisionId) { ?>
<?php case 1: echo "<td>2部</td>\n"; break; ?>
<?php case 2: echo "<td>3部</td>\n"; break; ?>
<?php case 3: echo "<td>5部</td>\n"; break; ?>
<?php case 4: echo "<td>6部</td>\n"; break; ?>
<?php case 5: echo "<td>7部</td>\n"; break; ?>
<?php case 6: echo "<td>8部</td>\n"; break; ?>
<?php } ?>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <input type="number" min="0" name="data[draw<?php echo $drawId; ?>][1<?php echo $divisionId; ?>]" class="inputDraw<?php echo $drawId; ?>" value="<?php echo $data['you1' . $divisionId . $drawId] ?>" style="font-size:90%; width:3em;" > 枚<br>
					計 <?php echo $data['sum1' . $divisionId . $drawId]; ?> (<?php echo $data['sumAll1' . $divisionId . $drawId] ?>) 枚<br>
					(<?php echo $data['join1' . $divisionId . $drawId]; ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you1' . $divisionId . '0']; ?> 枚<br>
					計 <?php echo $data['sum1' . $divisionId . '0']; ?> (<?php echo $data['sumAll1' . $divisionId . '0']; ?>) 枚<br>
					(<?php echo $data['join1' . $divisionId . '0']; ?> 人)
				</td>
			</tr>
<?php } ?>

            <tr>
				<td rowspan="7">8/8(土)</td>
				<th>　</th>
				<th class="cellDrawId1">1次<br><span class="txNormal">～3/27(金)</span></th>
				<th class="cellDrawId2">2次<br><span class="txNormal">～3/30(月)</span></th>
				<th class="cellDrawId3">3次<br><span class="txNormal">～4/02(木)</span></th>
				<th class="cellDrawId4">4次<br><span class="txNormal">～4/06(月)</span></th>
				<th class="cellDrawId5">5次<br><span class="txNormal">～4/08(水)</span></th>
				<th class="cellDrawId6">6次<br><span class="txNormal">～4/10(金)</span></th>
				<th class="cellDrawId7">7次<br><span class="txNormal">～4/13(月)</span></th>
				<th class="cellDrawId8">8次<br><span class="txNormal">～4/15(水)</span></th>
				<th>合計</th>
            </tr>
<?php for ($divisionId = 1; $divisionId <= 6; $divisionId++) { ?>
			<tr>
<?php switch ($divisionId) { ?>
<?php case 1: echo "<td>2部</td>\n"; break; ?>
<?php case 2: echo "<td>3部</td>\n"; break; ?>
<?php case 3: echo "<td>5部</td>\n"; break; ?>
<?php case 4: echo "<td>6部</td>\n"; break; ?>
<?php case 5: echo "<td>7部</td>\n"; break; ?>
<?php case 6: echo "<td>8部</td>\n"; break; ?>
<?php } ?>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <input type="number" min="0" name="data[draw<?php echo $drawId; ?>][2<?php echo $divisionId; ?>]" class="inputDraw<?php echo $drawId; ?>" value="<?php echo $data['you2' . $divisionId . $drawId] ?>" style="font-size:90%; width:3em;" > 枚<br>
					計 <?php echo $data['sum2' . $divisionId . $drawId]; ?> (<?php echo $data['sumAll2' . $divisionId . $drawId] ?>) 枚<br>
					(<?php echo $data['join2' . $divisionId . $drawId]; ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you2' . $divisionId . '0']; ?> 枚<br>
					計 <?php echo $data['sum2' . $divisionId . '0']; ?> (<?php echo $data['sumAll2' . $divisionId . '0']; ?>) 枚<br>
					(<?php echo $data['join2' . $divisionId . '0']; ?> 人)
				</td>
			</tr>
<?php } ?>

            <tr>
				<td rowspan="7">8/9(日)</td>
				<th>　</th>
				<th class="cellDrawId1">1次<br><span class="txNormal">～3/27(金)</span></th>
				<th class="cellDrawId2">2次<br><span class="txNormal">～3/30(月)</span></th>
				<th class="cellDrawId3">3次<br><span class="txNormal">～4/02(木)</span></th>
				<th class="cellDrawId4">4次<br><span class="txNormal">～4/06(月)</span></th>
				<th class="cellDrawId5">5次<br><span class="txNormal">～4/08(水)</span></th>
				<th class="cellDrawId6">6次<br><span class="txNormal">～4/10(金)</span></th>
				<th class="cellDrawId7">7次<br><span class="txNormal">～4/13(月)</span></th>
				<th class="cellDrawId8">8次<br><span class="txNormal">～4/15(水)</span></th>
				<th>合計</th>
            </tr>
<?php for ($divisionId = 1; $divisionId <= 6; $divisionId++) { ?>
			<tr>
<?php switch ($divisionId) { ?>
<?php case 1: echo "<td>2部</td>\n"; break; ?>
<?php case 2: echo "<td>3部</td>\n"; break; ?>
<?php case 3: echo "<td>5部</td>\n"; break; ?>
<?php case 4: echo "<td>6部</td>\n"; break; ?>
<?php case 5: echo "<td>7部</td>\n"; break; ?>
<?php case 6: echo "<td>8部</td>\n"; break; ?>
<?php } ?>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <input type="number" min="0" name="data[draw<?php echo $drawId; ?>][3<?php echo $divisionId; ?>]" class="inputDraw<?php echo $drawId; ?>" value="<?php echo $data['you3' . $divisionId . $drawId] ?>" style="font-size:90%; width:3em;" > 枚<br>
					計 <?php echo $data['sum3' . $divisionId . $drawId]; ?> (<?php echo $data['sumAll3' . $divisionId . $drawId] ?>) 枚<br>
					(<?php echo $data['join3' . $divisionId . $drawId]; ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you3' . $divisionId . '0']; ?> 枚<br>
					計 <?php echo $data['sum3' . $divisionId . '0']; ?> (<?php echo $data['sumAll3' . $divisionId . '0']; ?>) 枚<br>
					(<?php echo $data['join3' . $divisionId . '0']; ?> 人)
				</td>
			</tr>
<?php } ?>


			<tr>
				<td colspan="2">その他</td>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <input type="number" min="0" name="data[draw<?php echo $drawId; ?>][41]" class="inputDraw<?php echo $drawId; ?>" value="<?php echo $data['you41' . $drawId] ?>" style="font-size:90%; width:3em;" > 枚<br>
					計 <?php echo $data['sum41' . $drawId]; ?> (<?php echo $data['sumAll41' . $drawId] ?>) 枚<br>
					(<?php echo $data['join41' . $drawId]; ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you410']; ?> 枚<br>
					計 <?php echo $data['sum410']; ?> (<?php echo $data['sumAll410']; ?>) 枚<br>
					(<?php echo $data['join410']; ?> 人)
				</td>
			</tr>
			<tr>
				<td colspan="2">　</td>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
                    <?php echo $this->Html->link($this->Html->image('order.png', array('width' => '59', 'height' => '21')), '#', array('escape' => false, 'onclick' => "save('order', '" . $drawId ."');")); ?><br><br>
                    <?php echo $this->Html->link($this->Html->image('fix.png',   array('width' => '59', 'height' => '21')), '#', array('escape' => false, 'onclick' => "save('fix',   '" . $drawId ."');")); ?>
				</td>
<?php } ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="2">　</th>
				<td rowspan="2">　</th>
				<th class="cellDrawId1">1次<br><span class="txNormal">～3/27(金)</span></th>
				<th class="cellDrawId2">2次<br><span class="txNormal">～3/30(月)</span></th>
				<th class="cellDrawId3">3次<br><span class="txNormal">～4/02(木)</span></th>
				<th class="cellDrawId4">4次<br><span class="txNormal">～4/06(月)</span></th>
				<th class="cellDrawId5">5次<br><span class="txNormal">～4/08(水)</span></th>
				<th class="cellDrawId6">6次<br><span class="txNormal">～4/10(金)</span></th>
				<th class="cellDrawId7">7次<br><span class="txNormal">～4/13(月)</span></th>
				<th class="cellDrawId8">8次<br><span class="txNormal">～4/15(水)</span></th>
				<th>合計</th>
			</tr>
			<tr>
<?php for ($drawId = 1; $drawId <= 8; $drawId++) { ?>
				<td class="cellDrawId<?php echo $drawId; ?>">
					あなた <?php echo $data['you00' . $drawId] ?> 枚<br>
					計 <?php echo $data['sum00' . $drawId] ?> (<?php echo $data['sumAll00' . $drawId] ?>) 枚<br>
					(<?php echo $data['join00' . $drawId] ?> 人)
				</td>
<?php } ?>
				<td>
					あなた <?php echo $data['you000'] ?> 枚<br>
					計 <?php echo $data['sum000'] ?> (<?php echo $data['sumAll000'] ?>) 枚<br>
					(<?php echo $data['join000'] ?> 人)
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</section>
