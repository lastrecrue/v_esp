<?php

class Application_Model_DbTable_Multimedia extends Zend_Db_Table_Abstract
{

    protected $_name = 'multimedia';

    public function obtenirMultimedia($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idmultimedia = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement multimedia $id");
        }
        return $row->toArray();
    }
    
    public function ajouterMultimedia($label, $typeId) {
        $dateToday = date('Y-m-d H:i:s');
        $path =  '../Multimedia_Files/'.$typeId.'/';
        $data = array(
            'label' => $label,
            'path' => $path,
            'type_idtype' => $typeId,
            'date_creation' => $dateToday,
            'date_modification' => $dateToday
        );
        $this->insert($data);
    }

    public function modifierMultimedia($id, $label, $typeId) {
        $dateToday = date('Y-m-d H:i:s');
        $path =  '../Multimedia_Files/'.$typeId.'/';
        $data = array(
            'label' => $label,
            'path' => $path,
            'type_idtype' => $typeId,
            'date_modification' => $dateToday
        );
        $this->update($data,'idmultimedia = ' . (int) $id);
    }
    public function supprimerMultimedia($id) {
        $this->delete('idmultimedia =' . (int) $id);
    }

}

