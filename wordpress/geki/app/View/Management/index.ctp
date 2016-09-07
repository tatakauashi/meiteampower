<?php
//echo $this->Html->css( array('tabs', 'list'), array( 'inline' => false) );
echo $this->Html->script( array('jquery-1.10.2', 'list'), array( 'inline' => false));
?>
<form id="f" method="post" action="/geki/management/submit">

<section>
    <h2>パスワードの確認</h2>
    <label>パスワード：<br>
        <input type="password" name="data[ManagementInformation][password]" value="" style="width: 20em;" required="required">
    </label><br>
</section>

<section>
    <h2>パスフレーズの変更</h2>
    <label>パスフレーズ(現在)：<br>
        <input type="text" name="data[ManagementInformation][oldPassPhrase]" value="" style="width: 20em;" maxlength="40">
    </label><br>
    <label>パスフレーズ(新)：<br>
        <input type="text" name="data[ManagementInformation][newPassPhrase]" value="" style="width: 20em;" maxlength="40">
    </label><br>
    <label>パスフレーズ(確認)：<br>
        <input type="text" name="data[ManagementInformation][newPassPhraseConfirm]" value="" style="width: 20em;" maxlength="40">
    </label><br>
</section>

<section>
    <h2>サービスの変更</h2>
    <label>有効：<br>
        <input type="checkbox" name="data[ManagementInformation][running]" value="1">
    </label><br>
</section>

<div style="text-align: center;">
    <label><input type="submit" value="登録・更新" style="width: 80%"></label>
</div>
</form>
