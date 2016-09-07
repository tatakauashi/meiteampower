<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $site_name ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
    	echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex'));
    	echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width'));
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('geki');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($site_name, '.'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'.',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			*/ ?>
			<!--p>
				<?php echo $cakeVersion; ?>
			</p-->
			<p style="text-align:center;">
		        2016年酒井萌衣選挙対策本部
			</p>
		</div>
	</div>
<?php if (isset($name) && $name == 'tatakauashia') { ?>
	<?php echo $this->element('sql_dump'); ?>
<?php } ?>
</body>
</html>
