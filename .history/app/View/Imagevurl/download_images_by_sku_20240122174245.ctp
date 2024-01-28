<!-- app/View/Imagevurl/download_all_images.ctp -->
<!-- app/View/Imagevurl/download_all_images.ctp -->
<?php echo $this->Form->create('Imagevurl'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->input('', array('type' => 'textarea', 'label' => 'Enter SKU Codes (one per line)')); ?>
<?php echo $this->Form->submit('Download Images as zip'); ?>

<?php echo $this->Form->end(); ?>

