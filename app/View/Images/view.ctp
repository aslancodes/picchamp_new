<!-- app/View/Images/index.ctp -->

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 400px;
        max-height: 100px;
        border: 1px solid #ddd;
    }

    .delete-link {
        color: red;
        cursor: pointer;
        text-decoration: underline;
    }
</style>

<h2>All Images</h2>

<?php if ($images): ?>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>client id </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $image): ?>
                <tr>
                    <td>
                        <?php
                        if (isset($image['Image']['filename'])) {
                            $base64Data = base64_encode($image['Image']['filename']);
                            echo '<img src="data:image/png;base64,' . $base64Data . '" alt="Image">';
                        } else {
                            echo 'No image found.';
                        }
                        ?>
                    </td>
                    <td><?php echo h($image['Image']['description']); ?></td>
                    <td><?php echo h($image['Image']['client_ref_id']); ?></td>
                    <td>
                        <?php
                        echo $this->Form->postLink(
                            'Delete',
                            array('action' => 'delete', $image['Image']['id']),
                            array('confirm' => 'Are you sure?', 'class' => 'delete-link')
                        );
                        
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Html->link(
                            'Download',
                            array('controller' => 'images', 'action' => 'download', $image['Image']['id']),
                            array('class' => 'download-link')
                        );
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No images found.</p>
<?php endif; ?>
