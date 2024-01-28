<!-- app/View/Imagevurl/download_all_images.ctp -->
<?php echo $this->Form->create('Imagevur', array('url' => array('action' => 'downloadAllImages'))); ?>
<?php echo $this->Form->input('sku_codes', array('type' => 'textarea', 'label' => 'Enter SKU Codes (one per line)')); ?>
<?php echo $this->Form->submit('Download All Images as Zip'); ?>
<?php echo $this->Form->end(); ?>
