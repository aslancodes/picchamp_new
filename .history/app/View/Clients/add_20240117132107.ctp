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


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="alert alert-primary" role="alert">
  A simple primary alert—check it out!
</div>