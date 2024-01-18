<!-- app/View/Images/client_images.ctp -->
<h1>Client Images</h1>

<?php
echo $this->Form->create('Image');
echo $this->Form->input('client_ref_id', array('label' => 'Select Client', 'options' => $clients, 'empty' => ''));
echo $this->Form->end('Submit');
?>

<?php if (isset($selectedClientId)): ?>
    <h2>Images for Client: <?php echo $clients[$selectedClientId]; ?></h2>

    <?php if (!empty($images)): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Description</th>
                    <!-- Add other header columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($images as $image): ?>
                    <tr>
                        <td>
                            <!-- Display image in a table cell -->
                            <?php
                            $base64Image = base64_encode($image['Image']['filename']);
                            echo '<img src="data:image/png;base64,' . $base64Image . '" alt="Image" style="max-width: 100px; max-height: 100px;" />';
                            ?>
                        </td>
                        <td><?php echo h($image['Image']['description']); ?></td>
                        <!-- Add other columns as needed -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No images found for the selected client.</p>
    <?php endif; ?>

<?php endif; ?>
