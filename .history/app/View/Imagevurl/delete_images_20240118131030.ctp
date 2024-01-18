<!-- app/View/Imagevurl/delete_images.ctp -->
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->submit('Fetch Images'); ?>
<?php echo $this->Form->end(); ?>

<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <table>
        <tr>
            <th>SKU Code</th>
            <th>Image 1</th>
            <th>Image 2</th>
            <th>Image 3</th>
            <th>Image 4</th>
            <th>Image 5</th>
            <th>Action</th>
        </tr>
        <?php foreach ($images as $image): ?>
            <tr>
            <!-- <img src="<?php echo $image['Uploadimglink']['image1']; ?>" alt="Image 1"> -->
                <td><?php echo $image['Uploadimglink']['SKU_CODE']; ?></td>
                <td><img src = "<?php echo $image['Uploadimglink']['image1']; ?>" > </td>
                <td><img src = "<?php echo $image['Uploadimglink']['image2']; ?>" > </td>
                <td><img src = "<?php echo $image['Uploadimglink']['image3']; ?> " > </td>
                <td><img src = "<?php echo $image['Uploadimglink']['image4']; ?>" > </td>
                <td> <img src = "<?php echo $image['Uploadimglink']['image5']; ?></td>
                <td>
                    <?php echo $this->Form->postLink(
                        'Delete',
                        array('controller' => 'Imagevurl', 'action' => 'confirmDelete', $image['Uploadimglink']['id']),
                        array('confirm' => 'Are you sure you want to delete this image?')
                    ); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
