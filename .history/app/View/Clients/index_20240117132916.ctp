<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?php
echo $this->Form->create('Client', array('url' => array('controller' => 'clients', 'action' => 'index')));
echo $this->Form->input('client_id', array('options' => $clients));
echo $this->Form->end('Submit');


