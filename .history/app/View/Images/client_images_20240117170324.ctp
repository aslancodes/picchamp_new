<!-- app/View/Images/client_images.ctp -->
<h1>Client Images</h1>

<?php
echo $this->Form->create('Image');
echo $this->Form->input('client_ref_id', array('label' => 'Select Client', 'options' => $clients, 'empty' => ''));
echo $this->Form->end('Submit');
?>

<?php if (isset($selectedClientId)): ?>
    <h2>Images for Client: <?php echo $clients[$selectedClientId]; ?></h2>

    <?php foreach ($images as $image): ?>
        <!-- Display image information here -->
        <?php echo $this->Html->image('data:image/png;base64,' . base64_encode($image['Image']['filename'])); ?>
        <!-- Add other image details as needed -->
    <?php endforeach; ?>

<?php endif; ?>
