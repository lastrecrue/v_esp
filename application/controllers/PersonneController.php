<?php

class PersonneController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $personnes = new Application_Model_DbTable_Personne();
        $this->view->personnes = $personnes->fetchAll();
    }

    public function ajouterAction() {
        $form = new Application_Form_Personne();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $date_naissance = $form->getValue('date_naissance');
                $adresse = $form->getValue('adresse');
                $phone = $form->getValue('phone');
                $mail = $form->getValue('mail');
                $idcommune = $form->getValue('idcommune');
                $personnes = new Application_Model_DbTable_Personne();
                $personnes->ajouterPersonne($nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Personne();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $date_naissance = $form->getValue('date_naissance');
                $adresse = $form->getValue('adresse');
                $phone = $form->getValue('phone');
                $mail = $form->getValue('mail');
                $idcommune = $form->getValue('idcommune');
                $personnes = new Application_Model_DbTable_Personne();
                $personnes->modifierPersonne($id, $nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $personnes = new Application_Model_DbTable_Personne();
                $form->populate($personnes->obtenirPersonne($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $personnes = new Application_Model_DbTable_Personne();
                $personnes->supprimerPersonne($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $personnes = new Application_Model_DbTable_Personne();
            $this->view->personne = $personnes->obtenirPersonne($id);
        }
    }

}

