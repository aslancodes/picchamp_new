

<?php
class Image extends AppModel {
    public $name = 'Image';

    public $validate = array(
        'file' => array(
            'rule' => 'notEmpty',
            'message' => 'Please upload a file'
        )
    );

    


    public function getClientList() {
        return $this->Client->find('list', ['fields' => ['id', 'name']]);
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
