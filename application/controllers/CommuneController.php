<?php

class CommuneController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
        $communes = new Application_Model_DbTable_Commune();
        $this->view->communes = $communes->fetchAll();
    }

    public function communelistAction() {
        $communes = new Application_Model_DbTable_Commune();
        $select = $communes->select()->from('commune', array('idcommune', 'label'));
        $result = $communes->getAdapter()->query($select)->fetchAll();
        $data = new Zend_Dojo_Data('idcommune', $result);
        $this->_helper->autoCompleteDojo($data);
    }

    public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $commune = new Application_Model_DbTable_Commune();
        $communes = $commune->fetchAll();
        $dojoData = new Zend_Dojo_Data('idcommune', $communes, 'idcommune');
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);
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
                $id = $form->getValue('id');
                $label = $form->getValue('label');
                $nom = $form->getValue('nom');
                $communes = new Application_Model_DbTable_Commune();
                $communes->modifierCommune($id, $label, $nom);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
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
                $id = $this->getRequest()->getPost('id');
                $communes = new Application_Model_DbTable_Commune();
                $communes->supprimerCommune($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $communes = new Application_Model_DbTable_Commune();
            $this->view->commune = $communes->obtenirCommune($id);
        }
    }

}

