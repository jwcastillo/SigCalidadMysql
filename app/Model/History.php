<?php
App::uses('AppModel', 'Model');
/**
 * History Model
 *
 */
class History extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */


    public function getPackageId($id = null) {
        $this->id = $id;
        $history = $this->read();
        $packages = ClassRegistry::init('Packages');

        App::uses('CakeSession', 'Model/Datasource');
        
        $fields = array();
        $fields[] = "id";
        $conditions = array('Packages.number_package' => $history['History']['number_package']);

        $options = array('fields' => $fields, 'conditions' => $conditions);

        $result = $packages->find('first', $options);

        return $result;
        
        
    }
}
