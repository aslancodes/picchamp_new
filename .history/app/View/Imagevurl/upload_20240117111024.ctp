<!-- app/View/Images/upload.ctp -->
<?php echo $this->Form->create('Image', array('type' => 'file')); ?>
<?php echo $this->Form->input('file', array('type' => 'file')); ?>
<?php echo $this->Form->end('Upload'); ?>
