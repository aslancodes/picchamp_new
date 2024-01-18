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
<?php echo $this->Html->css('navbar.css'); ?>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div class="navbar">
    <div class="nav-logo"><?php echo $this->Html->link('Your Logo', array('controller' => 'pages', 'action' => 'display', 'home')); ?></div>
    <ul class="nav-links">
        <li><?php echo $this->Html->link('Home', array('controller' => 'pages', 'action' => 'display', 'home')); ?></li>
        <li><?php echo $this->Html->link('Add a client', array('controller' => 'Clients', 'action' => 'add')); ?></li>
        <li class="image-upload">
            <?php
                echo $this->Html->link('Image Upload', , array('id' => 'image-upload-link')); // Placeholder link for the dropdown
                echo '<ul class="dropdown-menu" style="display:none;">'; // Start of the dropdown menu
                echo '<li>' . $this->Html->link('Upload from URL', array('controller' => 'Imagevurl', 'action' => 'upload')) . '</li>'; // Sub-option for Via URL
				echo '<li>' . $this->Html->link('Upload from URL', array('controller' => 'Imagevurl', 'action' => 'upload')) . '</li>'; 
                echo '</ul>'; // End of the dropdown menu
            ?>
        </li>
        <li><?php echo $this->Html->link('View All Images', array('controller' => 'Images', 'action' => 'view')); ?></li>
    </ul>
</div>
	<div id="container">
		<!-- <div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div> -->
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageUploadLink = document.getElementById('image-upload-link');
        var dropdownMenu = document.querySelector('.image-upload .dropdown-menu');

        imageUploadLink.addEventListener('click', function(e) {
            e.preventDefault();
            // Toggle the visibility of the dropdown menu
            dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
        });
    });
</script>
</body>
</html>
