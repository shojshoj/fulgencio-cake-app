<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('FulCake | '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php ?>
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');
		echo $this->Html->css('mystyles');
		
		// echo $this->Html->css('vuetify/materialdesignicons.min.css');
		echo $this->Html->css('bootstrap/bootstrap-icons/font/bootstrap-icons.css');
		echo $this->Html->css('vuetify/vuetify.min.css');
		echo $this->Html->css('bootstrap/bootstrap.css');
		echo $html->css('/vue/icon.css');
		// echo $this->Html->css('/vuetify/vuetify.min.css');
		// echo $this->Html->css('element-plus/element-plus.css');

		echo $scripts_for_layout;
	?>
	<?php echo $this->Javascript->link('./vue/vue.global.js')?>
	<?php echo $this->Javascript->link('./axios/index.js')?>
	<?php //echo $this->Javascript->link('./vuetify/materialdesignicons.min.js')?>
	<?php echo $this->Javascript->link('./vuetify/vuetify.min.js')?>
	<?php //echo $this->Javascript->link('./element-plus/element-plus.js')?>
	<?php //echo $this->Javascript->link('./vue/axios.min.js')?>
	<?php //echo $this->Javascript->link('./vue/moment.min.js')?>
	
</head>
<body>
	<div id="container">
		<div id="header">
			<?php 
				echo $this->element(
					'nav-bar'
					// ,array('passingMoreData' => 'test')
				); 
			?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	
	<?php echo $this->Html->script('bootstrap/bootstrap.bundle.js')?>
</body>

</html>