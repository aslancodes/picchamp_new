<?php echo $this->Form->create('Client'); ?>
    <fieldset>
        <legend><?php echo __('Add Client'); ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('bt_client_id');
            
            echo $this->Form->input('s3_folder_name');
            echo $this->Form->input('brand');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
<?php echo $this->Html->link(__('Cancel'), array('action' => 'index')); ?>