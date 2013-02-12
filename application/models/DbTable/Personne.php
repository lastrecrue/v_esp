<?php

class Application_Model_DbTable_Personne extends Zend_Db_Table_Abstract {

    protected $_name = 'personne';

    public function obtenirPersonne($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idpersonne = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterPersonne($nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune) {
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'adresse' => $adresse,
            'phone' => $phone,
            'mail' => $mail,
            'commune_idcommune' => $idcommune
        );
        $this->insert($data);
    }

    public function modifierPersonne($id, $nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune) {
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'adresse' => $adresse,
            'phone' => $phone,
            'mail' => $mail,
            'idcommune' => $idcommune
        );
        $this->update($data, 'idpersonne = ' . (int) $id);
    }

    public function supprimerPersonne($id) {
        $this->delete('idpersonne =' . (int) $id);
    }


}

