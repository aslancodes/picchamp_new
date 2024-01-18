<?php
class Uploadimglink extends AppModel {
    public $name = 'Uploadimglink';


    
    public function getClientList() {
        return $this->Client->find('list', ['fields' => ['id', 'name']]);
    }
}