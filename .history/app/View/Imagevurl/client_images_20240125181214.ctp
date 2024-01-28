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



<!-- app/View/Imagevurl/client_images.ctp -->
<style>
    /* ... your existing style ... */
</style>
<!-- app/View/Imagevurl/client_images.ctp -->
<style>
    /* ... your existing style ... */
</style>

<?php echo $this->Form->create('Uploadimglink', ['id' => 'UploadimglinkForm']); ?>
<?php echo $this->Form->input('client_id', ['id' => 'UploadimglinkClientID', 'type' => 'select', 'options' => $clients]); ?>
<?php echo $this->Form->end(); ?>

<div id="clientImagesContainer">
    <?php echo $this->element('client_images'); ?>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Function to fetch images via AJAX
        function fetchImages(url) {
            // Perform AJAX request to fetch the next set of images
            $.ajax({
                type: 'POST',
                url: url,
                data: $('#UploadimglinkForm').serialize(), // Serialize form data
                success: function (data) {
                    // Replace the content of the container with the updated content
                    $('#clientImagesContainer').html(data);
                }
            });
        }

        // Listen for click events on pagination links
        $(document).on('click', '.paginator a', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            
            // Fetch images via AJAX
            fetchImages(url);
        });

        // Listen for changes in the client_id select dropdown
        $('#UploadimglinkClientID').change(function () {
            // Automatically fetch images when the client_id changes
            var url = '<?php echo $this->Html->url(['action' => 'clientImages']); ?>';
            fetchImages(url);
        });

        // Fetch images when the page loads
        var initialUrl = '<?php echo $this->Html->url(['action' => 'clientImages']); ?>';
        fetchImages(initialUrl);
    });
</script>




<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <table class="clientdetailstab">
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

    <!-- Display pagination links -->
    <div class="paginator">
        <?php echo $this->Paginator->prev('« Previous'); ?>
        <?php echo $this->Paginator->numbers(); ?>
        <?php echo $this->Paginator->next('Next »'); ?>
    </div>
<?php endif; ?>
