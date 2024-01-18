<!-- app/View/Imagevurl/client_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients)); ?>
<?php echo $this->Form->end('Fetch Images'); ?>

<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <ul>
        <?php foreach ($images as $image): ?>
            <li>
                <?php if (!empty($image['Uploadimglink']['image1'])): ?>
                    <img src="<?php echo $image['Uploadimglink']['image1']; ?>" alt="Image 1">
                <?php endif; ?>
            </li>
            <!-- Add similar lines for image2, image3, image4, image5 as needed -->
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
