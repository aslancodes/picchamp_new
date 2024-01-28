<?php echo $this->Form->create('Uploadimglink'); ?>
<?php echo $this->Form->input('client_id', [
    'type' => 'select',
    'options' => $clients,
    'label' => 'Select Client',
]); ?>
<?php echo $this->Form->input('sku_codes', [
    'type' => 'textarea',
    'label' => 'Enter SKU Codes (one per line)',
]); ?>
<?php echo $this->Form->submit('Download Images as CSV'); ?>
<?php echo $this->Form->end(); ?>

<!-- Popup for success message -->
<?php if ($this->Flash->check('success')): ?>
    <div id="success-popup" class="popup">
        <p><?php echo $this->Flash->render('success'); ?></p>
    </div>
    <script>
        // Close the success popup after a delay
        setTimeout(function () {
            document.getElementById('success-popup').style.display = 'none';
        }, 5000); // Adjust the delay (in milliseconds) as needed
    </script>
<?php endif; ?>
