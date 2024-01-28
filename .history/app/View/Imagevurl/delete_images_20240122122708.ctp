<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', array('type' => 'select', 'options' => $clients, 'label' => 'Select Client')); ?>
<?php echo $this->Form->submit('Fetch Images', array('id' => 'fetchImagesBtn')); ?>
<?php echo $this->Form->end(); ?>

<?php if (isset($images)): ?>
    <style>
        /* Your existing styles here */
    </style>

    <h2>Images for Selected Client</h2>
    <div id="imagesContainer">
        <table>
            <!-- Your table structure here -->
        </table>
    </div>

    <script>
        // Assuming you have included jQuery in your project
        $(document).ready(function () {
            // Function to update images based on selected client
            function updateImages(clientId) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Router::url(array('controller' => 'Imagevurl', 'action' => 'getUpdatedImages')); ?>',
                    data: { clientId: clientId },
                    success: function (data) {
                        $('#imagesContainer').html(data);
                    }
                });
            }

            // Fetch images on page load (assuming default client selection)
            var defaultClientId = <?php echo isset($defaultClientId) ? $defaultClientId : '0'; ?>;
            updateImages(defaultClientId);

            // Fetch images when "Fetch Images" button is clicked
            $('#fetchImagesBtn').click(function (e) {
                e.preventDefault();
                var clientId = $('select[name="data[Uploadimglink][client_id]"]').val();
                updateImages(clientId);
            });
        });
    </script>
<?php endif; ?>
