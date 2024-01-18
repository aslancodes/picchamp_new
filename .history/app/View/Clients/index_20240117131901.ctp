<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
echo $this->Form->create('Client', array('url' => array('controller' => 'clients', 'action' => 'index')));
echo $this->Form->input('client_id', array('options' => $clients));
echo $this->Form->end('Submit');


