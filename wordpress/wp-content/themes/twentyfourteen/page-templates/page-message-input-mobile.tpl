<?php namespace MEIMEI; ?>
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<TITLE><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?> <?php echo getXmlMsg('meimeiTitleForm'); ?></TITLE>
<META name="viewport" content="width=device-width">
<META name="keywords" content="����G��,Mei SAKAI,�߂��߂�,MEI-MEI,SKE48,�G�X �P�[ �C�[ �t�H�[�e�B�[�G�C�g,�`�[���d,Team E,���a��,��M�t�H�[��,Birthday Festival, Birthday card,�J�̃s�A�j�X�g,Pianist in the rain,������,Sunflower,�������,��������̏��D,�V�A�^�[�̏��D,AKB48,48�O���[�v,48 Group">
<META name="description" content="SKE48�`�[��E����G�߂���̐��a�J�[�h��M�t�H�[���ł��B�������̐��a�X�y�[�X�ɗ����Ȃ����̂��߂ɁA����G�߂���̂��a�������j�����b�Z�[�W�𑗐M���������A����ɐ��a�J�[�h�ɑ�M���Ď���G�߂���ɂ��͂����܂��B���������b�Z�[�W�����肢�������܂��B">
</HEAD>
<BODY>
<H2><?php echo getXmlMsg('meimeiTitleSakaiMei'); ?> <?php echo getXmlMsg('meimeiTitleForm'); ?></H2>
<FONT size="4">
<FORM name="form1" action="<?php echo get_permalink(); ?>" method="post">

<P><?php echo getXmlMsg('meimei_leadMessage'); ?></P>
<P><?php echo getXmlMsg('meimei_Required'); ?></P>

<P><?php echo getXmlMsg('meimei_input_meimei_name'); ?> <FONT color="#FF8000">(�E�ցE)�m</FONT><BR>
<INPUT type="text" name="meimei_name" value="<?php echo getPV("meimei_name"); ?>"><BR>
<FONT color="#FF0000"><?php echo getErrMsg("error_meimei_name"); ?></FONT>
</P>

<P>
<?php echo getXmlMsg('meimei_input_messageColor'); ?><BR>
<SELECT name="meimei_messageColor">
<OPTION value="1" <?php echo getPV('meimei_checked_messageColor_1'); ?>>����</OPTION>
<OPTION value="2" <?php echo getPV('meimei_checked_messageColor_2'); ?>>����</OPTION>
<OPTION value="3" <?php echo getPV('meimei_checked_messageColor_3'); ?>>����</OPTION>
<OPTION value="4" <?php echo getPV('meimei_checked_messageColor_4'); ?>>������</OPTION>
<OPTION value="5" <?php echo getPV('meimei_checked_messageColor_5'); ?>>�݂ǂ�</OPTION>
<OPTION value="6" <?php echo getPV('meimei_checked_messageColor_6'); ?>>�I�����W</OPTION>
<OPTION value="7" <?php echo getPV('meimei_checked_messageColor_7'); ?>>�ނ炳��</OPTION>
<OPTION value="8" <?php echo getPV('meimei_checked_messageColor_8'); ?>>���Ⴂ��</OPTION>
</SELECT>
</P>

<P>
<?php echo getXmlMsg('meimei_input_meimei_message'); ?> <FONT color="#FF8000">(�E�ցE)�m</FONT><BR>
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
