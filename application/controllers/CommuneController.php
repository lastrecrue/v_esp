<?php

class CommuneController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $communes = new Application_Model_DbTable_Commune();
        $this->view->communes = $communes->fetchAll();
    }

    public function ajouterAction() {
        $form = new Application_Form_Commune();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nom = $form->getValue('nom');
                $label = $form->getValue('label');
                $communes = new Application_Model_DbTable_Commune();
                $communes->ajouterCommune($label, $nom);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Commune();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('idcommune');
                $label = $form->getValue('label');
                $nom = $form->getValue('nom');
                $communes = new Application_Model_DbTable_Commune();
                $communes->modifierCommune($id, $label, $nom);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('idcommune', 0);
            if ($id > 0) {
                $communes = new Application_Model_DbTable_Commune();
                $form->populate($communes->obtenirCommune($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('idcommune');
                $communes = new Application_Model_DbTable_Commune();
                $communes->supprimerCommune($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('idcommune', 0);
            $communes = new Application_Model_DbTable_Commune();
            $this->view->commune = $communes->obtenirCommune($id);
        }
    }

}

