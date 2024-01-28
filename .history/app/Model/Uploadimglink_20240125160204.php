<?php
class Uploadimglink extends AppModel {
    public $name = 'Uploadimglink';


    // public $belongsTo = array(
    //     'Client' => array(
    //         'className' => 'Client',
    //         'foreignKey' => 'client_ref_id',
    //     )
    // ); 
    public function getClientList() {
        return $this->Client->find('list', ['fields' => ['id', 'name']]);
    }

    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_ref_id',
            'dependent' => false, // Disable cascading deletes
            'nullify' => true, // Set the foreign key to null on delete
        )
    );
}