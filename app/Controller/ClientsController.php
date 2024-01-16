
<?php

// app/Controller/ClientController.php

App::import('Vendor', 'PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet');
App::import('Vendor', 'PhpSpreadsheet/src/PhpSpreadsheet/Writer/Excel5');

class ClientsController extends AppController {

public function beforeFilter() {
    parent::beforeFilter();
    $this->loadModel('Client');
}

public function index(){
    $clients = $this->Client->find('list');
    $this->set('clients', $clients);
}

public function getClientDetails() {
    // Check if the form is submitted
    if ($this->request->is('post')) {
        $clientId = $this->request->data['Client']['client_id'];
        $clientDetails = $this->Client->findById($clientId);

        if ($clientDetails) {
            $this->set('clientDetails', $clientDetails);
        } else {
            $this->Session->setFlash('Client not found.', 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
    } else {
        // Redirect to index if form is not submitted
        $this->redirect(array('action' => 'index'));
    }
}

public function add() {
    if($this->request->is('post')){
        $this->Client->create();
        if($this->Client->save($this->request->data)) {
            $this->Session->setFlash("Client has been created");
            $this->redirect('index');
        }
    }
}

public function search() {
    $searchTerm = $this->request->query('search');

    if ($searchTerm) {
        $conditions = array(
            'OR' => array(
                'name LIKE' => '%' . $searchTerm . '%',
                'bt_client_id LIKE' => '%' . $searchTerm . '%',
                's3_folder_name LIKE' => '%' . $searchTerm . '%',
                'brand LIKE' => '%' . $searchTerm . '%',
            )
        );

        $clients = $this->Client->find('all', array('conditions' => $conditions));
    } else {
        $clients = array();
    }

    $this->set(compact('clients', 'searchTerm'));
}


}
