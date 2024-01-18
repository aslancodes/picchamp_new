<!-- app/View/Images/download_by_client.ctp -->
<h1>Download Image</h1>

<?php if (isset($image)): ?>
    <p>Client: <?php echo $clients[$image['Image']['client_ref_id']]; ?></p>

    <p>Image: <?php echo $image['Image']['original_filename']; ?></p>

    <?php
    echo $this->Html->link(
        'Download',
        array(
            'controller' => 'images',
            'action' => 'downloadByClient',
            $image['Image']['client_ref_id'],
            $image['Image']['id']
        ),
        array('class' => 'button')
    );
    ?>

<?php else: ?>
    <p>No image found for the selected client.</p>
<?php endif; ?>
