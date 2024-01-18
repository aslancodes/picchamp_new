<!-- app/View/Imagevurl/client_images.ctp -->
<style>
   
</style>
<?php
$this->Html->css('clientdetails');
?>
<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients)); ?>
<?php echo $this->Form->end('Fetch Images'); ?>

<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <table class = "clientdetailstab">
        <thead>
            <tr>
                <th>SKU Code</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $image): ?>
                <tr>
                    <td><?php echo $image['Uploadimglink']['SKU_CODE']; ?></td>
                    <td>
                        <?php if (!empty($image['Uploadimglink']['image1'])): ?>
                            <img src="<?php echo $image['Uploadimglink']['image1']; ?>" alt="Image 1">
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
