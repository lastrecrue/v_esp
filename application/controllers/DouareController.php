<?php

class DouareController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $douares = new Application_Model_DbTable_Douare();
        $this->view->douares = $douares->fetchAll();
    }

    public function ajouterAction() {
        $form = new Application_Form_Douare();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nom = $form->getValue('nom');
                $label = $form->getValue('label');
                $gps_alt = $form->getValue('gps_alt');
                $gps_lan = $form->getValue('gps_lan');
                $idcommune = $form->getValue('idcommune');

                $douares = new Application_Model_DbTable_Douare();
                $douares->ajouterDouare($label, $nom, $gps_alt, $gps_lan, $idcommune);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Douare();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $label = $form->getValue('label');
                $nom = $form->getValue('nom');
                $gps_alt = $form->getValue('gps_alt');
                $gps_lan = $form->getValue('gps_lan');
                $idcommune = $form->getValue('idcommune');
                $douares = new Application_Model_DbTable_Douare();
                $douares->modifierDouare($id, $label, $nom, $gps_alt, $gps_lan, $idcommune);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $douares = new Application_Model_DbTable_Douare();
                $form->populate($douares->obtenirDouare($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $douares = new Application_Model_DbTable_Douare();
                $douares->supprimerDouare($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $douares = new Application_Model_DbTable_Douare();
            $this->view->douare = $douares->obtenirDouare($id);
        }
    }

}

