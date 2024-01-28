<!-- app/View/Imagevurl/download_all_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->input('sku_codes', array('label' => 'Enter SKU Codes (comma-separated)')); ?>
<?php echo $this->Form->submit('Download Images as ZIP'); ?>
<?php echo $this->Form->end(); ?>

