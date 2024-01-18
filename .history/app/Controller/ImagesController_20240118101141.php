<?php 
// app/Controller/ImagesController.php
class ImagesController extends AppController {

    public $components = array(
        'RequestHandler',
        // ... other components
    );

    public $name = 'Images';

    public function index() {
        $this->set('images', $this->Image->find('all'));
     
    }

    public function add() {
        $this->loadModel('Image');
        // Assuming your Client model is named Client
        $clients = $this->Image->getClientList();
        $this->set('clients', $clients);

if ($this->request->is('post')) {
    $file = $this->request->data['Image']['file'];

    if (!empty($file['name']) && getimagesize($file['tmp_name'])) {
        $fileContent = file_get_contents($file['tmp_name']);

        $this->loadModel('Image');
        
        $data = [
            'filename' => $fileContent,
            'original_filename' => $file['name'],
            'description' => $this->request->data['Image']['description'],
            'client_ref_id' => $this->request->data['Image']['client_ref_id'],
            'created_at' => date('Y-m-d H:i:s') // Assuming 'created_at' is a datetime field
        ];

        $this->Image->create();

        if ($this->Image->save($data)) {
            $this->Session->setFlash('Image uploaded successfully.');
            return $this->redirect(['action' => 'view']);
        } else {
            $this->Session->setFlash('Unable to save image details to the database. Please, try again.');
        }
    } else {
        $this->Session->setFlash('Please upload a valid image file.');
    }
// Rest of your code
        }        
    }
    public function view(){
        $images = $this->Image->find('all');
        $this->set('images', $images);
    }
    public function delete($id) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->Image->id = $id;

        if (!$this->Image->exists()) {
            throw new NotFoundException(__('Invalid image'));
        }

        // Attempt to delete the image
        if ($this->Image->delete()) {
            $this->Session->setFlash('The image has been deleted.');
        } else {
            $this->Session->setFlash('Unable to delete the image. Please, try again.');
        }

        return $this->redirect(['action' => 'view']);
    }

    public function download($id) {
        $image = $this->Image->findById($id);
    
        if (!$image) {
            throw new NotFoundException(__('Invalid image'));
        }
    
        // Ensure that 'filename' is set in the image data
        if (!isset($image['Image']['filename'])) {
            throw new InternalErrorException(__('Invalid image data'));
        }
    
        $filename = $image['Image']['original_filename']; // Use the original filename
        $fileContent = $image['Image']['filename'];
    
        // Create a temporary file to store the blob data
        $tempFilePath = tempnam(sys_get_temp_dir(), 'download_');
        file_put_contents($tempFilePath, $fileContent);
    
        // Send the file as a response
        $this->response->file($tempFilePath, array('download' => true, 'name' => $filename));
    
        // Return the response object to initiate the download
        return $this->response;
    }

   

    // public function clientImages() {
    //     // Fetch client list for the dropdown
    //     $clients = $this->Image->getClientList();
    //     $this->set('clients', $clients);

    //     if ($this->request->is('post')) {
    //         $selectedClientId = $this->request->data['Image']['client_ref_id'];

    //         // Fetch images for the selected client
    //         $images = $this->Image->find('all', array(
    //             'conditions' => array('Image.client_ref_id' => $selectedClientId)
    //         ));

    //         $this->set('selectedClientId', $selectedClientId);
    //         $this->set('images', $images);
    //     }
    // }


    public function downloadByClient($clientId, $imageId) {
        $image = $this->Image->find('first', array(
            'conditions' => array(
                'Image.id' => $imageId,
                'Image.client_ref_id' => $clientId
            )
        ));

        if (!$image) {
            throw new NotFoundException(__('Invalid image'));
        }

        // Ensure that 'filename' is set in the image data
        if (!isset($image['Image']['filename'])) {
            throw new InternalErrorException(__('Invalid image data'));
        }

        $filename = $image['Image']['original_filename']; // Use the original filename
        $fileContent = $image['Image']['filename'];

        // Create a temporary file to store the blob data
        $tempFilePath = tempnam(sys_get_temp_dir(), 'download_');
        file_put_contents($tempFilePath, $fileContent);

        // Send the file as a response
        $this->response->file($tempFilePath, array('download' => true, 'name' => $filename));

        // Return the response object to initiate the download
        return $this->response;
    }

}
