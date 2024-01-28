<?php
// App::uses('HttpSocket', 'Network/Http');

class ImagevurlController extends AppController {

public $helpers = array('Html', 'Form');
public $components = array('Session');


public function clientImages() {
    $clients = $this->Uploadimglink->getClientList();
    $this->set('clients', $clients);

    if ($this->request->is('post')) {
        $clientId = $this->request->data['Uploadimglink']['client_id'];
        $images = $this->Uploadimglink->find('all', array(
            'conditions' => array('Uploadimglink.client_ref_id' => $clientId),
        ));
        $this->set('images', $images);
    }
}
public function index(){
    $this->loadModel('Client');
    $clients = $this->Client->find('list', ['fields' => ['id', 'name']]);
    $this->set('clients', $clients);
}
   
    // need to work upon this 
    public function downloadImagesBySku() {
        $clients = $this->Uploadimglink->getClientList();
        $this->set('clients', $clients);
    
        if ($this->request->is('post')) {
            $clientId = $this->request->data['Uploadimglink']['client_id'];
            $skuCodesInput = $this->request->data['Uploadimglink']['sku_codes'];
    
            // Split the input into an array of SKU codes
            $skuCodes = explode(PHP_EOL, $skuCodesInput);
            $skuCodes = array_map('trim', $skuCodes);
    
            $conditions = [
                'Uploadimglink.client_ref_id' => $clientId,
                'Uploadimglink.SKU_CODE' => $skuCodes,
            ];
    
            // Find images based on conditions
            $images = $this->Uploadimglink->find('all', [
                'conditions' => $conditions,
            ]);
    
            // Check if any images are found
            if (!empty($images)) {
                // Generate a unique zip file name
                $zipFileName = 'images_' . time() . '.zip';
                $zipFilePath = TMP . $zipFileName;
    
                foreach ($images as $image) {
                    // Open the zip file and append image content
                    file_put_contents($zipFilePath, "{$image['Uploadimglink']['SKU_CODE']}_image1.jpg\n", FILE_APPEND | LOCK_EX);
                    file_put_contents($zipFilePath, file_get_contents($image['Uploadimglink']['image1']) . "\n", FILE_APPEND | LOCK_EX);
                    file_put_contents($zipFilePath, "{$image['Uploadimglink']['SKU_CODE']}_image2.jpg\n", FILE_APPEND | LOCK_EX);
                    file_put_contents($zipFilePath, file_get_contents($image['Uploadimglink']['image2']) . "\n", FILE_APPEND | LOCK_EX);
                    file_put_contents($zipFilePath, "{$image['Uploadimglink']['SKU_CODE']}_image3.jpg\n", FILE_APPEND | LOCK_EX);
                    file_put_contents($zipFilePath, file_get_contents($image['Uploadimglink']['image3']) . "\n", FILE_APPEND | LOCK_EX);
                                    // ... continued from the previous code

                file_put_contents($zipFilePath, "{$image['Uploadimglink']['SKU_CODE']}_image5.jpg\n", FILE_APPEND | LOCK_EX);
                file_put_contents($zipFilePath, file_get_contents($image['Uploadimglink']['image5']) . "\n", FILE_APPEND | LOCK_EX);
            }

            // Set the response header for ZIP download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment;filename=' . $zipFileName);
            header('Cache-Control: max-age=0');
            readfile($zipFilePath);

            // Delete the temporary zip file
            unlink($zipFilePath);

            exit;
        } else {
            // Handle the case where no images are found for the given criteria
            $this->Session->setFlash('No images found for the specified criteria.');
        }
    }
}

    
    
    // Function to create a ZIP file from a directory
    private function createZip($source, $destination) {
        $zipFile = fopen($destination, 'w');
    
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
    
        foreach ($files as $file) {
            $file = realpath($file);
    
            if (is_dir($file)) {
                continue;
            }
    
            $zipPath = substr($file, strlen($source) + 1);
    
            fwrite($zipFile, "{$zipPath}\n");
            fwrite($zipFile, file_get_contents($file) . "\n");
        }
    
        fclose($zipFile);
    }
    
    // Function to recursively remove a directory and its contents
    private function removeDirectory($path) {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        rmdir($path);
    }
  
    
    //***-------------- functions (working)
       
    public $uses = array('Uploadimglink', 'Client'); // Include the Client model

//upload csv (image upload)
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
                $this->Session->setFlash('Error reading .CSV file.');
            }
        } else {
            $this->Session->setFlash('Please select a CSV file.');
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
                'image6' => $row[6],
                'image7' => $row[7],
                'image8' => $row[8],
                'client_ref_id' => $this->request->data['Uploadimglink']['client_ref_id'],
            )
        );

        $this->Uploadimglink->create();
        $this->Uploadimglink->save($data);
    }
}


//functions for the uploading of the images FROM HDD

// public function addImages() {
//     $clients = $this->Uploadimglink->getClientList();
//     $this->set('clients', $clients);

//     if ($this->request->is('post')) {
//         $skuCodes = explode(',', $this->request->data['Uploadimglink']['sku_codes']);
//         $clientId = $this->request->data['Uploadimglink']['client_id'];

//         // Pass SKU codes and client ID to the next action
//         $this->redirect(array(
//             'controller' => 'Imagevurl',
//             'action' => 'uploadImages',
//             '?' => array(
//                 'sku_codes' => $skuCodes,
//                 'client_id' => $clientId,
//             )
//         ));
//     }
// }

public function addImages() {
    $clients = $this->Uploadimglink->getClientList();
    $this->set('clients', $clients);

    if ($this->request->is('post')) {
        // Validate SKU codes
        $this->Uploadimglink->set($this->request->data);
        if ($this->Uploadimglink->validates(['fieldList' => ['sku_codes']])) {
            $skuCodes = explode(',', $this->request->data['Uploadimglink']['sku_codes']);
            $clientId = $this->request->data['Uploadimglink']['client_id'];

            // Pass SKU codes and client ID to the next action
            $this->redirect([
                'controller' => 'Imagevurl',
                'action' => 'uploadImages',
                '?' => [
                    'sku_codes' => $skuCodes,
                    'client_id' => $clientId,
                ]
            ]);
        } else {
            // Validation failed, set error messages
            $this->Session->setFlash->error('SKU Codes cannot be empty.');
        }
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
                'image6' => $this->_uploadAndConvertToLink($skuCode, 6),
                'image7' => $this->_uploadAndConvertToLink($skuCode, 7),
                'image8' => $this->_uploadAndConvertToLink($skuCode, 8),
                // Add other necessary fields
            )
        );
        $this->Uploadimglink->create();
        $this->Uploadimglink->save($data);
    }
}
private function _uploadAndConvertToLink($skuCode, $imageNumber) {
    $uploadedFile = $this->request->data['Uploadimglink']['image_' . $skuCode . '_' . $imageNumber];
    $targetFolder = WWW_ROOT . 'uploads' . DS;

    // Create the uploads folder if it doesn't exist
    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }
    $targetFile = $targetFolder . basename($uploadedFile['name']);

    if (move_uploaded_file($uploadedFile['tmp_name'], $targetFile)) {
        // Return the link to the uploaded file


        //add aws function to add 
        unlink($targetFile);
        return '/uploads/' . $uploadedFile['name'];
    } else {
        // Handle upload failure
        return null;
    }
}


//need to work.......
public function downloadImages() {
    $clients = $this->Uploadimglink->getClientList();
    $this->set('clients', $clients);

    if ($this->request->is('post')) {
        $clientId = $this->request->data['Uploadimglink']['client_id'];
        $skuCodesInput = $this->request->data['Uploadimglink']['sku_codes'];

        // Split the input into an array of SKU codes
        $skuCodes = explode(PHP_EOL, $skuCodesInput);
        $skuCodes = array_map('trim', $skuCodes);

        $conditions = array('Uploadimglink.client_ref_id' => $clientId);

        // Add condition to filter by SKU codes if provided
        if (!empty($skuCodes)) {
            if (count($skuCodes) > 1) {
                $conditions['Uploadimglink.SKU_CODE IN'] = $skuCodes;
            } else {
                $conditions['Uploadimglink.SKU_CODE'] = $skuCodes[0];
            }
        }

        $images = $this->Uploadimglink->find('all', array(
            'conditions' => $conditions,
        ));

        $this->set('images', $images);

        // Set the response header for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=images.csv');
        header('Cache-Control: max-age=0');

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Output CSV header
        fputcsv($output, array('client id', 'SKU_CODE', 'Image 1', 'Image 2', 'Image 3', 'Image 4', 'Image 5', 'Image 6','Image 7', 'Image 8' ));

        // Output CSV data
        foreach ($images as $image) {
            $rowData = array(
                $image['Uploadimglink']['client_ref_id'],
                $image['Uploadimglink']['SKU_CODE'],
                $image['Uploadimglink']['image1'],
                $image['Uploadimglink']['image2'],
                $image['Uploadimglink']['image3'],
                $image['Uploadimglink']['image4'],
                $image['Uploadimglink']['image5'],
                $image['Uploadimglink']['image6'],
                $image['Uploadimglink']['image7'],
                $image['Uploadimglink']['image8'],
            );
            fputcsv($output, $rowData);
        }

        // Close the output stream

    
        fclose($output);

        exit;
    }
}

//download as zip actual images 
public function downloadAllImages() {
    if ($this->request->is('post')) {
        $skuCodesInput = $this->request->data['Uploadimglink']['sku_codes'];

        // Split the input into an array of SKU codes
        $skuCodes = explode(PHP_EOL, $skuCodesInput);
        $skuCodes = array_map('trim', $skuCodes);

        // Fetch images based on SKU codes
        $images = $this->Uploadimglink->find('all', array(
            'conditions' => array('Uploadimglink.SKU_CODE IN' => $skuCodes),
        ));

        // Create a temporary folder to store converted images
        $tempFolder = TMP . 'converted_images' . DS;
        if (!is_dir($tempFolder)) {
            mkdir($tempFolder);
        }

        // Convert image links to actual images and store in the temporary folder
        foreach ($images as $image) {
            for ($i = 1; $i <= 5; $i++) {
                $imageLink = $image['Uploadimglink']['image' . $i];
                if (!empty($imageLink)) {
                    $imageUrl = WWW_ROOT . $imageLink;
                    $imageData = file_get_contents($imageUrl);
                    $tempFilename = $tempFolder . $image['Uploadimglink']['SKU_CODE'] . '_' . $i . '.jpg';
                    file_put_contents($tempFilename, $imageData);
                }
            }
        }

        // Create a zip archive
        $zipFilename = WWW_ROOT . 'images.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = glob($tempFolder . '*');
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }

        // Set the response header for zip file download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment;filename=images.zip');
        header('Cache-Control: max-age=0');

        // Output the zip file
        readfile($zipFilename);

        // Remove temporary folder and zip file
        $this->_rrmdir($tempFolder);
        unlink($zipFilename);

        exit;
    }
}

private function _rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (is_dir($dir . '/' . $object)) {
                    $this->_rrmdir($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }
        rmdir($dir);
    }
}

///delete image section updated  
public function deleteImages() {
    // $this->autoRender = false;
    $clients = $this->Uploadimglink->getClientList();
    $this->set('clients', $clients);
    if ($this->request->is('post')) {
        $clientId = $this->request->data['Uploadimglink']['client_id'];

        $images = $this->Uploadimglink->find('all', array(
            'conditions' => array('Uploadimglink.client_ref_id' => $clientId),
        ));
        $this->set('images', $images);
    }
}


public function confirmDelete($imageId) {
    // Check if the image ID exists
    if (!$this->Uploadimglink->exists($imageId)) {
        throw new NotFoundException(__('Invalid image'));
    }

    if ($this->request->is('post')) {
        // Fetch image data
        $image = $this->Uploadimglink->findById($imageId);

        // Delete image files from the filesystem
        $this->_deleteImageFiles($image);

        // Delete image entry from the database
        $this->Uploadimglink->delete($imageId);

        // Display a success message
        $this->Session->setFlash('Image deleted successfully.');

        // Redirect to the deleteImages action with the client ID
        $clientId = $image['Uploadimglink']['client_ref_id'];
        $this->redirect(array('action' => 'deleteImages', 'client_id' => $clientId));
    }

    // Redirect to the deleteImages action if not a POST request
    $this->redirect(array('action' => 'deleteImages'));
}


private function _deleteImageFiles($image) {
    // Delete image files from the filesystem
    $imageFields = array('image1', 'image2', 'image3', 'image4', 'image5');

    foreach ($imageFields as $field) {
        if (!empty($image['Uploadimglink'][$field]) && file_exists(WWW_ROOT . $image['Uploadimglink'][$field])) {
            unlink(WWW_ROOT . $image['Uploadimglink'][$field]);
        }
    }
}

}

//deleted codes 
// private function _deleteImageFiles($image) {
//     // Delete image files from the filesystem
//     if (!empty($image['Uploadimglink']['image1'])) {
//         unlink(WWW_ROOT . $image['Uploadimglink']['image1']);
//     }
//     if (!empty($image['Uploadimglink']['image2'])) {
//         unlink(WWW_ROOT . $image['Uploadimglink']['image2']);
//     }
//     if (!empty($image['Uploadimglink']['image3'])) {
//         unlink(WWW_ROOT . $image['Uploadimglink']['image3']);
//     }
//     if (!empty($image['Uploadimglink']['image4'])) {
//         unlink(WWW_ROOT . $image['Uploadimglink']['image4']);
//     }
//     if (!empty($image['Uploadimglink']['image5'])) {
//         unlink(WWW_ROOT . $image['Uploadimglink']['image5']);
//     }
// }