<?php

class MultimediaController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
        // $multimedia = new Application_Model_DbTable_Multimedia();
        // $this->view->multimedia = $multimedia->fetchAll;
    }

    public function indexjsonAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);

        $multimedia = new Application_Model_DbTable_Multimedia();
        $data = $multimedia->fetchAll()->toArray();
        $dataArray = array('identifier' => 'idmultimedia', 'items' => $data);
        $json = Zend_Json::encode($dataArray);
//       Zend_Json::encode($json)
        return $response->setBody($json);
    }

    public function ajouterAction() {
        $form = new Application_Form_Multimedia();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $this->uploadFile();

                $idtype = $form->getValue('type_idtype');
                $label = $form->getValue('label');

                $multimedia = new Application_Model_DbTable_Multimedia();
                $multimedia->ajouterMultimedia($label, $idtype);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    private function uploadFile() {
        // Check for Post and Validate your form before this
        // Define a transport and set the destination on the server
        $upload = new Zend_File_Transfer_Adapter_Http();
        $upload->setDestination('C:\xampp\htdocs\v_esp\upload');


        try {
            // This takes care of the moving and making sure the file is there
            $upload->receive();
            // Dump out all the file info
            Zend_Debug::dump($upload->getFileInfo());
        } catch (Zend_File_Transfer_Exception $e) {
            echo $e->message();
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Multimedia();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $idtype = $form->getValue('type_idtype');
                $label = $form->getValue('label');

                $multimedia = new Application_Model_DbTable_Multimedia();
                try {
                    $multimedia->modifierMultimedia($id, $label, $idtype);
                } catch (Exception $e) {
                    $this->getLog()->log("modifier multimedia : " . $e, Zend_Log::ERR);
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $multimedia = new Application_Model_DbTable_Multimedia();
                $form->populate($multimedia->obtenirMultimedia($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('idmultimedia');
                $multimedia = new Application_Model_DbTable_Multimedia();
                $multimedia->supprimerMultimedia($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $multimedia = new Application_Model_DbTable_Multimedia();
            $this->view->personne = $multimedia->obtenirMultimedia($id);
        }
    }

    public function getLog() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

}

