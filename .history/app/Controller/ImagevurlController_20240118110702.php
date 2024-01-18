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

    
    public $uses = array('Uploadimglink', 'Client'); // Include the Client model

    public function upload() {
        $clients = $this->Uploadimglink->getClientList();
        $this->set('clients', $clients);

        if ($this->request->is('post')) {
            $file = $this->request->data['Uploadimglink']['file'];

            if ($file['error'] === UPLOAD_ERR_OK) {
                $csvData = $this->_readCSV($file['tmp_name']);

                if (!empty($csvData)) {
                    $this->_processCSVData($csvData);
                    $this->Session->setFlash('CSV file processed and data inserted into db successfully.');
                } else {
                    $this->Session->setFlash('Error reading CSV file.');
                }
            } else {
                $this->Session->setFlash('Error uploading file.');
            }
        }
    }

    private function _readCSV($filePath) {
        $csvData = array();

        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $csvData[] = $data;
            }
            fclose($handle);
        }

        return $csvData;
    }

    private function _processCSVData($csvData) {
        foreach ($csvData as $row) {
            $skuCode = $row[0]; // Assuming SKU code is in the first column

            $data = array(
                'Uploadimglink' => array(
                    'SKU_CODE' => $skuCode,
                    'image1' => $row[1],
                    'image2' => $row[2],
                    'image3' => $row[3],
                    'image4' => $row[4],
                    'image5' => $row[5],
                    'client_ref_id' => $this->request->data['Uploadimglink']['client_ref_id'],
                )
            );

            $this->Uploadimglink->create();
            $this->Uploadimglink->save($data);
        }
    }




    //functions for the uploading of the images 

    public function addImages() {
        $clients = $this->Uploadimglink->getClientList();
        $this->set('clients', $clients);

        if ($this->request->is('post')) {
            $skuCodes = explode(',', $this->request->data['Uploadimglink']['sku_codes']);
            $clientId = $this->request->data['Uploadimglink']['client_id'];

            // Pass SKU codes and client ID to the next action
            $this->redirect(array(
                'controller' => 'Imagevurl',
                'action' => 'uploadImages',
                '?' => array(
                    'sku_codes' => $skuCodes,
                    'client_id' => $clientId,
                )
            ));
        }
    }

    public function uploadImages() {
        // Retrieve SKU codes and client ID from the URL parameters
        $skuCodes = $this->params['url']['sku_codes'];
        $clientId = $this->params['url']['client_id'];

        // Set the SKU codes and client ID in the view
        $this->set('skuCodes', $skuCodes);
        $this->set('clientId', $clientId);

        if ($this->request->is('post')) {
            // Process image uploads and store data in the database
            $this->_processImageUploads($skuCodes, $clientId);
            $this->Session->setFlash('Images uploaded and data inserted into db successfully.');
        }
    }

    private function _processImageUploads($skuCodes, $clientId) {
        foreach ($skuCodes as $skuCode) {
            // Save data in the database based on your requirements
            $data = array(
                'Uploadimglink' => array(
                    'SKU_CODE' => $skuCode,
                    'client_ref_id' => $clientId,
                    'image1' => $this->_uploadAndConvertToLink($skuCode, 1),
                    'image2' => $this->_uploadAndConvertToLink($skuCode, 2),
                    'image3' => $this->_uploadAndConvertToLink($skuCode, 3),
                    'image4' => $this->_uploadAndConvertToLink($skuCode, 4),
                    'image5' => $this->_uploadAndConvertToLink($skuCode, 5),
                    // Add other necessary fields
                )
            );

            $this->Uploadimglink->create();
            $this->Uploadimglink->save($data);
        }
    }

    
}