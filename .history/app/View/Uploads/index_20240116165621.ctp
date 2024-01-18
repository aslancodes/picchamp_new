<!-- app/View/Uploads/index.ctp -->

<div class="container-fluid">
    <div class="page-header">
        <h3>Upload Images to S3 via Local(HardDisk)</h3>
    </div>
    <?php
        echo $this->Form->create('Upload', array('url' => array('controller' => 'uploads', 'action' => 'uploadImages'), 'class' => 'form-inline', 'enctype' => 'multipart/form-data'));
        echo $this->Form->input('skusList', array('type' => 'textarea', 'label' => 'Put search string (one per line)', 'style' => 'width: 500px; height: 80px;'));
        echo $this->Form->input('folderName', array('type' => 'select', 'label' => 'Select the folder to save', 'class' => 'form-control', 'options' => $clients, 'empty' => 'Select Client'));
        echo $this->Form->submit('Upload Skus', array('class' => 'btn btn-primary'));
        echo $this->Form->end();
    ?>
    <hr />
    <?php echo $this->Session->flash(); ?>
</div>
