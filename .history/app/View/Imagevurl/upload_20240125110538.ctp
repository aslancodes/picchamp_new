<!-- app/View/Images/upload.ctp -->

<?php echo $this->Form->create('Uploadimglink', array('type' => 'file')); ?>
<?php echo $this->Form->input('file', array('type' => 'file')); ?>
<?php echo $this->Form->input('client_ref_id', array('type' => 'select', 'options' => $clients)); ?>
<?php echo $this->Form->end('Upload'); ?>
