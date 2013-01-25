<?php

class Application_Model_DbTable_Commune extends Zend_Db_Table_Abstract {

    protected $_name = 'commune';

    public function obtenirCommune($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idcommune = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterCommune($label, $nom) {
        $data = array(
            'label' => $label,
            'nom' => $nom,
        );
        $this->insert($data);
    }

    public function modifierCommune($id, $label, $nom) {
        $data = array(
            'label' => $label,
            'nom' => $nom,
        );
        $this->update($data, 'idcommune = ' . (int) $id);
    }

    public function supprimerCommune($id) {
        $this->delete('idcommune =' . (int) $id);
    }

}

