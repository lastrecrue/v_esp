<?php

class Application_Model_DbTable_Type extends Zend_Db_Table_Abstract {

    protected $_name = 'type';

    public function obtenirType($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idtype = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterType($label) {
        $data = array(
            'label' => $label
        );
        $this->insert($data);
    }

    public function modifierType($id, $label) {
        $data = array(
            'label' => $label
        );
        $this->update($data, 'idtype = ' . (int) $id);
    }

    public function supprimerType($id) {
        $this->delete('idtype =' . (int) $id);
    }

}

