<?php
// app/Controller/UploadsController.php

class UploadsController extends AppController {
    public $name = 'Uploads';
    public $uses = array(); // Specify that this controller doesn't use any model

    public function index() {
        // Fetch client list from the database
        $this->loadModel('Client');
        $clients = $this->Client->find('list', array(
            'fields' => array('s3_folder_name', 'name'),
            'order' => 'name ASC'
        ));

        $this->set('clients', $clients);
    }

    public function uploadImages() {
        if ($this->request->is('post')) {
            $skusList = $this->request->data['skusList'];
            $folderName = $this->request->data['folderName'];

            // Add your logic for processing form data and uploading images to S3
            // ...

            // Set flash message
            $this->Session->setFlash('Images uploaded successfully.', 'flash/success');
        } else {
            // Invalid form submission
            $this->Session->setFlash('Invalid form submission.', 'flash/error');
        }

        // Redirect back to the index page
        $this->redirect(array('action' => 'index'));
    }







    //new functions 
}
?>
