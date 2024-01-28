<!-- app/View/Imagevurl/download_all_images.ctp -->
<!-- app/View/Imagevurl/download_all_images.ctp -->
<!-- Assuming your view file is download_images_by_sku.ctp -->
<?php
    echo $this->Form->create('Uploadimglink');
    echo $this->Form->input('client_id', ['type' => 'select', 'options' => $clients, 'label' => 'Select Client']);
    echo $this->Form->input('sku_codes', ['label' => 'Enter SKU Codes (one per line)', 'type' => 'textarea']);
    echo $this->Form->submit('Download Images as ZIP');
    echo $this->Form->end();
?>


