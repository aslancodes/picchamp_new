<!-- app/View/Imagevurl/client_images.ctp -->
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    img {
        max-width: 100px;
        max-height: 100px;
    }
</style>

<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients)); ?>
<?php echo $this->Form->end('Fetch Images'); ?>

<?php if (isset($images)): ?>
    <h2>Images for Selected <?php $clients?></h2>
    <table>
        <thead>
            <tr>
                <th>SKU Code</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 0; ?>
            <?php foreach ($images as $image): ?>
                <?php if ($counter % 6 == 0): ?>
                    <tr>
                <?php endif; ?>
                
                <td><?php echo $image['Uploadimglink']['SKU_CODE']; ?></td>
                <td>
                    <?php if (!empty($image['Uploadimglink']['image1'])): ?>
                        <img src="<?php echo $image['Uploadimglink']['image1']; ?>" alt="Image 1">
                    <?php endif; ?>
                </td>
                
                <?php $counter++; ?>
                
                <?php if ($counter % 6 == 0): ?>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php if ($counter % 6 != 0): ?>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>
