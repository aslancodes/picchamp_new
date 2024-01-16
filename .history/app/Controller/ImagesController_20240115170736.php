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
        // Assuming your Client model is named Client
        $this->loadModel('Client');
        $clients = $this->Client->find('list', ['fields' => ['id', 'name']]);
        $this->set('clients', $clients);
        
        if ($this->request->is('post')) {
            $file = $this->request->data['Image']['file'];
        
            if (!empty($file['name']) && getimagesize($file['tmp_name'])) {
                $fileContent = file_get_contents($file['tmp_name']);
        
                $this->loadModel('Image');
                $this->Image->create();
                
                $data = [
                    'filename' => $fileContent,
                    'original_filename' => $file['name'],
                    'description' => $this->request->data['Image']['description'],
                    'client_ref_id' => $this->request->data['Image']['client_ref_id'],
                ];
        
                $this->Image->set($data);
        
                if ($this->Image->save($data)) {
                    $this->Session->setFlash('Image uploaded successfully.');
                    $this->redirect(['action' => 'view']);
                } else {
                    $this->Session->setFlash('Unable to save image details to the database. Please, try again.');
                }
            } else {
                $this->Session->setFlash('Please upload a valid image file.');
            }
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

        return $this->redirect(['action' => 'index']);
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

        $filename = $image['Image']['filename'];
        $file = WWW_ROOT . 'img' . DS . $filename;

        // Check if the file exists
        if (!file_exists($file)) {
            throw new NotFoundException(__('File not found'));
        }

        // Send the file as a response
        $this->response->file($file);

        // Provide a name for the downloaded file
        $this->response->download($filename);

        // Return the response object to initiate the download
        return $this->response;
    }

   
}
