<?php

class Application_Model_DbTable_Douare extends Zend_Db_Table_Abstract {

    protected $_name = 'douare';

    public function obtenirDouare($id) {
        $id = (int) $id;
        $row = $this->fetchRow('iddouare = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterDouare($label, $nom, $gps_alt, $gps_lan, $idcommune) {
        $data = array(
            'label' => $label,
            'nom' => $nom,
            'gps_alt' => $gps_alt,
            'gps_lan' => $gps_lan,
            'commune_idcommune' => $idcommune
        );
        $this->insert($data);
    }

    public function modifierDouare($id, $label, $nom, $gps_alt, $gps_lan, $idcommune) {
        $data = array(
            'label' => $label,
            'nom' => $nom,
            'gps_alt' => $gps_alt,
            'gps_lan' => $gps_lan,
            'commune_idcommune' => $idcommune
        );
        $this->update($data, 'iddouare = ' . (int) $id);
    }

    public function supprimerDouare($id) {
        $this->delete('iddouare =' . (int) $id);
    }

}

