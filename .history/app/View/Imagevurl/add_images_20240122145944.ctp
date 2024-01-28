<!-- app/View/Imagevurl/add_images.ctp -->

<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('sku_codes', [
    'type' => 'textarea',
    'label' => 'Enter SKU Codes (comma-separated)',
    'required' => true, // Make the field required
]); ?>
<?php echo $this->Form->input('client_id', [
    'type' => 'select',
    'options' => $clients,
    'label' => 'Select Client',
]); ?>
<?php echo $this->Form->submit('Upload SKUs'); ?>
<?php echo $this->Form->end(); ?>

