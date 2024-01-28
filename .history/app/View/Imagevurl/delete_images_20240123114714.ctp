<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->submit('Fetch Images'); ?>
<?php echo $this->Form->end(); ?>

<?php if (isset($images)): ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #009879;
            color: white;
        }

        img {
            max-width: 100px; /* Adjust the max-width as per your requirement */
            height: auto;
        }
    </style>

    <h2>Images for Selected Client</h2>
    <table class="delete_table">
        <tr>
            <th>SKU Code</th>
            <th>Image 1</th>
            <th>Image 2</th>
            <th>Image 3</th>
            <th>Image 4</th>
            <th>Image 5</th>
            <th>Image 6</th>
            <th>Image 7</th>
            <th>Image 8</th>
            <th>Action</th>
        </tr>
        <?php foreach ($images as $image): ?>
            <tr>
                <td><?php echo $image['Uploadimglink']['SKU_CODE']; ?></td>
                <td><img src="<?php echo $image['Uploadimglink']['image1']; ?>" alt="Image 1"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image2']; ?>" alt="Image 2"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image3']; ?>" alt="Image 3"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image4']; ?>" alt="Image 4"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image5']; ?>" alt="Image 5"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image6']; ?>" alt="Image 6"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image7']; ?>" alt="Image 7"></td>
                <td><img src="<?php echo $image['Uploadimglink']['image8']; ?>" alt="Image 8"></td>
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
