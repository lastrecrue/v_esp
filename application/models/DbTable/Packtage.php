<?php

class Application_Model_DbTable_Packtage extends Zend_Db_Table_Abstract {

    protected $_name = 'packtage';

    public function obtenirPacktage($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idpacktage = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterPacktage($label) {
        $data = array(
            'label' => $label,
        );
        $this->insert($data);
    }

    public function modifierPacktage($id, $label) {
        $data = array(
            'label' => $label,
        );
        $this->update($data, 'idpacktage = ' . (int) $id);
    }

    public function supprimerPacktage($id) {
        $this->delete('idpacktage =' . (int) $id);
    }

}

