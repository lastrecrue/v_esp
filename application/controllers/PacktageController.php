<?php

class PacktageController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
        $packtages = new Application_Model_DbTable_Packtage();
        $this->view->packtages = $packtages->fetchAll();
    }
    
     public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        
        
        $packtage = new Application_Model_DbTable_Packtage();
        $packtages = $packtage->fetchAll()->toArray();
        $dataArray = array('identifier' => 'idpacktage', 'items' => $packtages);
        $json = Zend_Json::encode($dataArray);
        return $response->setBody($json);
    }

    public function ajouterAction() {
        $form = new Application_Form_Packtage();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $label = $form->getValue('label');
                $packtages = new Application_Model_DbTable_Packtage();
                $packtages->ajouterPacktage($label);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function packtagelistAction() {
        $packtages = new Application_Model_DbTable_Packtage();
        $select = $packtages->select()->from('packtage', array('idpacktage', 'label'));
        $result = $packtages->getAdapter()->query($select)->fetchAll();
        $data = new Zend_Dojo_Data('idpacktage', $result);
        $this->_helper->autoCompleteDojo($data);
    }

    public function modifierAction() {
        $form = new Application_Form_Packtage();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $label = $form->getValue('label');
                $packtages = new Application_Model_DbTable_Packtage();
                try {               
                    $packtages->modifierPacktage($id, $label);
                } catch (Exception $e) {
                    $this->getLog()->log("modifier patcktage : " . $e, Zend_Log::ERR);
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $douares = new Application_Model_DbTable_Packtage();
                $form->populate($douares->obtenirPacktage($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('idpacktage');
                $packtages = new Application_Model_DbTable_Packtage();
                $packtages->supprimerPacktage($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $packtages = new Application_Model_DbTable_Packtage();
            $this->view->packtage = $packtages->obtenirPacktage($id);
        }
    }

}

