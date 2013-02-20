<?php

class Application_Model_DbTable_Expedition extends Zend_Db_Table_Abstract {

    protected $_name = 'expedition';

    public function obtenireExpedition($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idexpedition = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function supprimerExpedition($id) {
        $this->delete('idexpedition = ' . $id);
    }

    public function modifierExpedition($id, $label, $date_init, $date_reel, $nb_famille, $idpacktage) {

        $data = array(
            'label' => $label,
            'date_init' => $date_init,
            'date_reel' => $date_reel,
            'nb_famille' => $nb_famille,
            'packtage_idpacktage' => $idpacktage
        );
        $this->update($data, 'idexpedition = ' . $id);
    }

    public function ajouterExpedition($label, $date_int, $date_reel, $nb_famille, $idpacktage) {
        $data = array(
            'label' => $label,
            'date_init' => $date_int,
            'date_reel' => $date_reel,
            'nb_famille' => $nb_famille,
            'packtage_idpacktage' => $idpacktage
        );        
        $this->insert($data);
    }

}

