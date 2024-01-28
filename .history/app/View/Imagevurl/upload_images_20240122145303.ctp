<!-- app/View/Imagevurl/upload_images.ctp -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .sku-section {
        display: flex ;
        margin-bottom: 20px; /* Adjust margin as needed */
    }

    .sku-section h2 {
        margin-bottom: 10px; /* Adjust margin as needed */
    }

    .sku-section input[type="file"] {
        display: block;
        margin-bottom: 10px; /* Adjust margin as needed */
    }
</style>
</head>
<body>
<?php echo $this->Form->create('Uploadimglink', array('type' => 'file')); ?>
<?php echo $this->Form->input('client_id', array('type' => 'hidden', 'value' => $clientId)); ?>

<?php foreach ($skuCodes as $skuCode): ?>

    
    <h2>SKU Code: <?php echo $skuCode; ?></h2>
    <div class="sku-section">
        
        <?php echo $this->Form->input('sku_codes[]', array('type' => 'hidden', 'value' => $skuCode)); ?>
        <?php echo $this->Form->input("image_{$skuCode}_1", array('type' => 'file', 'label' => 'Image 1')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_2", array('type' => 'file', 'label' => 'Image 2')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_3", array('type' => 'file', 'label' => 'Image 3')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_4", array('type' => 'file', 'label' => 'Image 4')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_5", array('type' => 'file', 'label' => 'Image 5')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_6", array('type' => 'file', 'label' => 'Image 6')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_7", array('type' => 'file', 'label' => 'Image 7')); ?>
        <?php echo $this->Form->input("image_{$skuCode}_8", array('type' => 'file', 'label' => 'Image 8')); ?>
    </div>
<?php endforeach; ?>

<?php echo $this->Form->submit('Upload Images'); ?>
<?php echo $this->Form->end(); ?>

</body>
</html>

