<?php

class DouareController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
        $douares = new Application_Model_DbTable_Douare();
        $this->view->douares = $douares->fetchAll();
    }

    public function indexjsonAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $communes = new Application_Model_DbTable_Douare();
        $data = $communes->fetchAll()->toArray();
        $dataArray = array('identifier' => 'iddouare', 'items' => $data);
        $json = Zend_Json::encode($dataArray);
        return $response->setBody($json);
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
                $idcommune = $form->getValue('commune_idcommune');

                $douares = new Application_Model_DbTable_Douare();
                $douares->ajouterDouare($label, $nom, $gps_alt, $gps_lan, $idcommune);

                $this->_helper->redirector('index');
            } else {                
                //TODO
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
                $id = $this->_getParam('id', 0);
                $label = $form->getValue('label');
                $nom = $form->getValue('nom');
                $gps_alt = $form->getValue('gps_alt');
                $gps_lan = $form->getValue('gps_lan');
                $idcommune = $form->getValue('commune_idcommune');
                $douares = new Application_Model_DbTable_Douare();
                $communes = new Application_Model_DbTable_Commune();
                try {               
                    $douares->modifierDouare($id, $label, $nom, $gps_alt, $gps_lan, $idcommune);
                } catch (Exception $e) {
                    $this->getLog()->log("modifier douare : " . $e, Zend_Log::ERR);
                }
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
                $id = $this->getRequest()->getPost('iddouare');
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

