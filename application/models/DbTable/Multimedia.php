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
    
    public function ajouterMultimedia($label, $path, $typeId) {
        $dateToday = date('Y-m-d H:i:s');
        $data = array(
            'label' => $label,
            'path' => $path,
            'type_idtype' => $typeId,
            'date_creation' => $dateToday,
        );
        $this->insert($data);
    }

    public function modifierMultimedia($id, $label, $path, $typeId) {
        $dateToday = date('Y-m-d H:i:s');
        $data = array(
            'label' => $label,
            'path' => $path,
            'type_idtype' => $typeId,
            'date_modificaton' => $dateToday
        );
        $this->update($data,'idmultimedia = ' . (int) $id);
    }
    public function supprimerMultimedia($id) {
        $this->delete('idmultimedia =' . (int) $id);
    }

}

