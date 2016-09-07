<section>
	<h2>2016年酒井選対票確保状況登録・確認</h2>
<?php if (!empty($errMsg)) { ?>
<p style="color:red; font-size: larger; font-weight: bold;"><?php echo $errMsg ?></p>
<?php } ?>
<?php
	echo $this->Form->create('Login', array(
		'type' => 'post',
		'url'  => 'login'
	));

	echo $this->Form->input('Login.passPhrase', array(
		'value' => '',
		'label' => 'パスフレーズ'
	));

	echo $this->Form->input('Login.loginId', array(
		'label' => 'ユーザー名'
	));

//	echo $this->Form->input('Login.keepLogin', array(
//		'type' => 'checkbox',
//		'hiddenField' => false,
//		'label' => 'ログインしたままにする'
//	));

	echo $this->Form->submit('すすむ');
	echo $this->Form->end();
?>
</section>
