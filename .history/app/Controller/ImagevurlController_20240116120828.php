<?php 

// app/Controller/ImagesController.php
class ImagevurlController extends AppController {

    public function index(){
        $this->loadModel('Client');
        $clients = $this->Client->find('list', ['fields' => ['id', 'name']]);
        $this->set('clients', $clients);
    }

    

}