<?php
/**
 *
 *
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
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		//echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div class="navbar">
    <div class="nav-logo"><?php echo $this->Html->link('Your Logo', array('controller' => 'pages', 'action' => 'display', 'home')); ?></div>
    <ul class="nav-links" img >
        <li><?php echo $this->Html->link('Images', array('controller' => 'pages', 'action' => 'display', 'home')); ?></li>
        <li><?php echo $this->Html->link('Image Manager', array('controller' => 'images', 'action' => 'manager')); ?></li>
        <li><?php echo $this->Html->link('Image Upload', array('controller' => 'images', 'action' => 'add')); ?></li>
    </ul>
</div>
</body>
</html>
