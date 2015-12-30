<?php namespace MEIMEI; ?>
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<TITLE><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?> <?php echo getXmlMsg('meimeiTitleForm'); ?></TITLE>
<META name="viewport" content="width=device-width">
<META name="keywords" content="酒井萌衣,Mei SAKAI,めいめい,MEI-MEI,SKE48,エス ケー イー フォーティーエイト,チームＥ,Team E,生誕祭,代筆フォーム,Birthday Festival, Birthday card,雨のピアニスト,Pianist in the rain,向日葵,Sunflower,劇場公演,劇場公演の女優,シアターの女優,AKB48,48グループ,48 Group">
<META name="description" content="SKE48チームE酒井萌衣さんの生誕カード代筆フォームです。握手会会場の生誕スペースに来られない方のために、酒井萌衣さんのお誕生日を祝うメッセージを送信いただき、代わりに生誕カードに代筆して酒井萌衣さんにお届けします。温かいメッセージをお願いいたします。">
</HEAD>
<BODY>
<H2><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?> <?php echo getXmlMsg('meimeiTitleForm'); ?></H2>
<FONT size="4">
<FORM name="form1" action="<?php echo get_permalink(); ?>" method="post">

<P><?php echo getXmlMsg('meimei_leadMessage'); ?></P>
<P><?php echo getXmlMsg('meimei_Required'); ?></P>

<P><?php echo getXmlMsg('meimei_input_meimei_name'); ?> <FONT color="#FF8000">(・ω・)ノ</FONT><BR>
<INPUT type="text" name="meimei_name" value="<?php echo getPV("meimei_name"); ?>"><BR>
<FONT color="#FF0000"><?php echo getErrMsg("error_meimei_name"); ?></FONT>
</P>

<P>
<?php echo getXmlMsg('meimei_input_messageColor'); ?><BR>
<SELECT name="meimei_messageColor">
<OPTION value="1" <?php echo getPV('meimei_checked_messageColor_1'); ?>>くろ</OPTION>
<OPTION value="2" <?php echo getPV('meimei_checked_messageColor_2'); ?>>あか</OPTION>
<OPTION value="3" <?php echo getPV('meimei_checked_messageColor_3'); ?>>あお</OPTION>
<OPTION value="4" <?php echo getPV('meimei_checked_messageColor_4'); ?>>きいろ</OPTION>
<OPTION value="5" <?php echo getPV('meimei_checked_messageColor_5'); ?>>みどり</OPTION>
<OPTION value="6" <?php echo getPV('meimei_checked_messageColor_6'); ?>>オレンジ</OPTION>
<OPTION value="7" <?php echo getPV('meimei_checked_messageColor_7'); ?>>むらさき</OPTION>
<OPTION value="8" <?php echo getPV('meimei_checked_messageColor_8'); ?>>ちゃいろ</OPTION>
</SELECT>
</P>

<P>
<?php echo getXmlMsg('meimei_input_meimei_message'); ?> <FONT color="#FF8000">(・ω・)ノ</FONT><BR>
<TEXTAREA name="meimei_message" rows="4" _cols="10"><?php echo getPV("meimei_message"); ?></TEXTAREA><BR>
<FONT color="#FF0000"><?php echo getErrMsg("error_meimei_message"); ?></FONT>
</P>
<B><FONT color="#ff0000"><?php echo $htmlEncode; ?></FONT></B>
<DIV align="center">
<IMG src="<?php echo get_stylesheet_directory_uri(); ?>/images/mokomoko_200.jpg"><BR>
<INPUT type="submit" value="<?php echo getXmlMsg('meimei_Submit'); ?>">
</DIV>

<INPUT type="hidden" name="meimei_lang" value="<?php echo getPV("meimei_lang"); ?>">
<INPUT type="hidden" name="meimei_lang_hidden" value="<?php echo getPV("meimei_lang_hidden"); ?>">
<INPUT type="hidden" name="meimei_htmlEncode" value="1">
<INPUT type="hidden" name="meimei_featurePhone" value="1">
</FORM>
</FONT>
<HR size="2">
<FONT size="2">Presented by <?php echo getXmlMsg('meimei_PresentedBy'); ?></FONT>
</BODY>
</HTML>
