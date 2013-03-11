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
            'commune_idcommune' => $idcommune
        );
        $this->update($data, 'idpersonne = ' . (int) $id);
    }

    public function supprimerPersonne($id) {
        $this->delete('idpersonne =' . (int) $id);
    }

    public function getPersonneInExpedition($id) {
        $sql = "select * from expedition_has_type_personne  where  expedition_idexpedition = " . $id;
        $stmt = $this->getAdapter()->query($sql);
        $result = $stmt->fetchAll();
        if(empty($result)){
            return false;
        }
        return $result;
    }

    public function getPersonneNotInExpedition($id) {
        $sqlin = "select personne_idpersonne from expedition_has_type_personne  where  expedition_idexpedition = " . $id;
        $sql = "select *from personne  where idpersonne not in (" . $sqlin . ")";

        $stmt = $this->getAdapter()->query($sql);

        $result = $stmt->fetchAll();
        if(empty($result)){
            return false;
        }
        return $result;
    }

}

