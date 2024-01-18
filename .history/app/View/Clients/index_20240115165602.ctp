<?php
echo $this->Form->create('Client', array('url' => array('controller' => 'clients', 'action' => 'index')));
echo $this->Form->input('client_id', array('options' => $clients));
echo $this->Form->end('Submit');


