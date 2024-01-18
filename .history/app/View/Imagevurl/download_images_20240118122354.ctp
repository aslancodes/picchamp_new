<!-- app/View/Imagevurl/download_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->submit('Download Images as CSV'); ?>
<?php echo $this->Form->end(); ?>
