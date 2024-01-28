<!-- app/View/Imagevurl/download_images.ctp -->
<!-- app/View/Imagevurl/download_images.ctp -->
<?php echo $this->Form->create('Imagevurl', array('url' => array('controller' => 'Imagevurl', 'action' => 'downloadImages'))); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->input('sku_codes', array('type' => 'textarea', 'label' => 'Enter SKU Codes (one per line)')); ?>
<?php echo $this->Form->submit('Download Images as CSV'); ?>
<?php echo $this->Form->end(); ?>

<?php echo $this->Form->create('Imagevurl', array('url' => array('controller' => 'Imagevurl', 'action' => 'downloadAllImages'))); ?>
<?php echo $this->Form->input('sku_codes', array('type' => 'textarea', 'label' => 'Enter SKU Codes (one per line)')); ?>
<?php echo $this->Form->submit('Download All Images as Zip'); ?>
<?php echo $this->Form->end(); ?>

