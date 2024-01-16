<?php echo $this->Form->create('Image', array('type' => 'file')); ?>

<?php echo $this->Form->input('file', array('type' => 'file')); ?>
<?php echo $this->Form->input('description'); ?>

<!-- Display the dropdown for client IDs -->
<?php echo $this->Form->input('client_ref_id', array('options' => $clients, 'empty' => 'Select Client')); ?>

<?php echo $this->Form->end('Upload'); ?>