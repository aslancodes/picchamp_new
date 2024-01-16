<?php 

// app/Controller/ImagesController.php
class ImagevurlController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Session');

    public function index(){
        $this->loadModel('Client');
        $clients = $this->Client->find('list', ['fields' => ['id', 'name']]);
        $this->set('clients', $clients);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Image->create();

            // Upload image to S3
            $s3Link = $this->uploadToS3($this->request->data['Image']['file']['tmp_name']);

            // Save data to the local database
            $this->request->data['Image']['filename'] = $s3Link;
            if ($this->Image->save($this->request->data)) {
                $this->Session->setFlash('Image uploaded successfully.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to save image.');
            }
        }
    }

    private function uploadToS3($tmpFilePath) {
        // Load AWS SDK and configure
        App::import('Vendor', 'aws/aws-autoloader');
        Aws\Common\Aws::factory(array(
            'key' => 'YOUR_AWS_KEY',
            'secret' => 'YOUR_AWS_SECRET',
            'region' => 'YOUR_AWS_REGION'
        ));

        // Create an S3 client
        $s3 = Aws\S3\S3Client::factory();

        // Generate a unique filename
        $filename = 'image_' . time() . '.jpg';

        // Upload the file to S3
        $s3->putObject(array(
            'Bucket' => 'YOUR_S3_BUCKET_NAME',
            'Key' => $filename,
            'SourceFile' => $tmpFilePath,
            'ACL' => 'public-read',
        ));

        // Generate the S3 link
        $s3Link = 'https://' . 'YOUR_S3_BUCKET_NAME' . '.s3.amazonaws.com/' . $filename;

        return $s3Link;
    }

}