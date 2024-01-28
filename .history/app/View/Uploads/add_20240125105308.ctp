<?php

echo $this->Form->create('Image', array('type' => 'file'));
echo $this->Form->input('file', array('type' => 'file'));
echo $this->Form->input('description');
echo $this->Form->input('client_ref_id');
echo $this->Form->end('Upload');


