<!-- app/View/Imagevurl/add_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('sku_codes', array('type' => 'textarea', 'label' => 'Enter SKU Codes (comma-separated)')); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->submit('Upload SKUs'); ?>
<?php echo $this->Form->end(); ?>
