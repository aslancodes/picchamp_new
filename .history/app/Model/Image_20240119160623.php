

<?php
class Image extends AppModel {
    public $name = 'Image';

    public $validate = array(
        'file' => array(
            'rule' => 'notEmpty',
            'message' => 'Please upload a file'
        )
    );

    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_ref_id',
        )
    );

    public function getClientList() {
        return $this->Client->find('list', ['fields' => ['id', 'name']]);
    }



    public function uploadFile($check) {
        $file = current($check);

        // Perform additional validation if needed

        return true;
    }

    // app/Model/Image.php

    // public $actsAs = array(
    //     'Media.Media' => array('fields' => array('filename' => 'image'))
    // );


    // public $actsAs = array(
    //     'Upload.Upload' => array(
    //         'file' => array(
    //             'fields' => array(
    //                 'dir' => 'dir'
    //             )
    //         )
    //     )
    // );
}
