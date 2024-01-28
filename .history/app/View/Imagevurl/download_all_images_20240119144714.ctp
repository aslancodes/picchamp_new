<!-- app/View/Imagevurl/download_all_images.ctp -->

<?php echo $this->Form->create('Imagevurl', array('url' => array('action' => 'downloadAllImages'))); ?>

<?php
    echo $this->Form->input('client_id', array(
        'type' => 'select',
        'options' => $clients,
        'label' => 'Select Client',
        'empty' => '(All Clients)', // Add this if you want an option for all clients
    ));
?>

<?php echo $this->Form->submit('Download All Images as Zip'); ?>
<?php echo $this->Form->end(); ?>

