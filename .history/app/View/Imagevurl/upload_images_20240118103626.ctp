<!-- app/View/Imagevurl/upload_images.ctp -->
<?php echo $this->Form->create('Uploadimglink', array('type' => 'file')); ?>
<?php echo $this->Form->input('client_id', array('type' => 'hidden', 'value' => $clientId)); ?>
<?php echo $this->Form->input('sku_codes', array('type' => 'hidden', 'value' => implode(',', $skuCodes))); ?>
<?php echo $this->Form->input('image1', array('type' => 'file')); ?>
<?php echo $this->Form->input('image2', array('type' => 'file')); ?>
<?php echo $this->Form->input('image3', array('type' => 'file')); ?>
<?php echo $this->Form->input('image4', array('type' => 'file')); ?>
<?php echo $this->Form->input('image5', array('type' => 'file')); ?>
<?php echo $this->Form->submit('Upload Images'); ?>
<?php echo $this->Form->end(); ?>
