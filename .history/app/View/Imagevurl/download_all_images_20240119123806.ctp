<!-- app/View/Imagevurl/download_all_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>

<?php
    echo $this->Form->input('client_id', array(
        'type' => 'select',
        'options' => $clients,
        'label' => 'Select Client',
        'empty' => '(All Clients)', // Add this if you want an option for all clients
    ));
?>

<?php echo $this->Form->input('sku_codes', array('type' => 'textarea', 'label' => 'Enter SKU Codes (one per line)')); ?>
<?php echo $this->Form->submit('Download All Images as Zip'); ?>
<?php echo $this->Form->end(); ?>
