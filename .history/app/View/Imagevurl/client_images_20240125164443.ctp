<!-- app/View/Imagevurl/client_images.ctp -->
<style>
    table {
        width: 50%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #f2f2f2; /* Set your desired background color */
    }
    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    img {
        max-width: 200px; /* Set your desired max-width for the image */
        max-height: 150px; /* Set your desired max-height for the image */
        display: block;
        margin: 0 auto; /* Center the image within its container */
    }
</style>

<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients)); ?>
<?php echo $this->Form->end('Fetch Images'); ?>

<!-- app/View/Imagevurl/client_images.ctp -->
<!-- ... your existing code ... -->

<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <table class="clientdetailstab">
        <!-- ... your existing table code ... -->
    </table>

    <!-- Display pagination links -->
    <div class="paginator">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('« Previous'); ?>
            <?php echo $this->Paginator->numbers(); ?>
            <?php echo $this->Paginator->next('Next »'); ?>
        </ul>
    </div>
<?php endif; ?>

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

