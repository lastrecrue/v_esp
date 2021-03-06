<?php

class ExpeditionController extends Zend_Controller_Action {

    public function init() {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
//        $expeditions = new Application_Model_DbTable_Expedition();
//        $this->view->expeditions = $expeditions->fetchAll();
    }

    public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $expedition = new Application_Model_DbTable_Expedition();
        $expeditions = $expedition->fetchAll();
        $dojoData = new Zend_Dojo_Data('idexpedition', $expeditions, 'idexpedition');
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);
    }
    
   

    public function ajouterAction() {
        $form = new Application_Form_Expedition(0);
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $label = $form->getValue('label');
                
                $date_init = new Zend_Date();
                $date_init->set($form->getValue('date_init'), 'dd/MM/yy');
                $date_reel = $form->getValue('date_reel');
                if ($date_reel) {
                    $date_reel = new Zend_Date();
                    $date_reel->set($date_reel, 'dd/MM/yy');
                } else {
                    $date_reel = new Zend_Date();
                    $date_reel->set('01/01/9999', 'dd/MM/yy');
                }
                $nb_famille = (int) $form->getValue('nb_famille');

                $idpacktage = (int) $form->getValues('idpacktage');
                
                $personneId = $form->getValue('personneId');

                $expeditions = new Application_Model_DbTable_Expedition();
                $expeditions->ajouterExpedition($label, $date_init->toString('YYYY-MM-dd HH:mm:ss'), $date_reel->toString('YYYY-MM-dd HH:mm:ss'), $nb_famille, $idpacktage, $personneId );

                $this->_helper->redirector('index');
            } else {

                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $id = $this->_getParam('id', 0);

        $form = new Application_Form_Expedition(array('id' => $id));
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;


        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $label = $form->getValue('label');

                $date_init = new Zend_Date();
                $date_init->set($form->getValue('date_init'), 'dd/MM/yy');
                $date_reel = $form->getValue('date_reel');
                if ($date_reel) {
                    $date_reel = new Zend_Date();
                    $date_reel->set($date_reel, 'dd/MM/yy');
                } else {
                    $date_reel = new Zend_Date();
                    $date_reel->set('01/01/9999', 'dd/MM/yy');
                }
                $nb_famille = (int) $form->getValue('nb_famille');
                $expeditions = new Application_Model_DbTable_Expedition();
                $expeditions->modifierExpedition($id, $label, $date_init, $date_reel, $nb_famille);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $expeditions = new Application_Model_DbTable_Expedition();
                $form->populate($expeditions->obtenireExpedition($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $expeditions = new Application_Model_DbTable_Expedition();
                $expeditions->supprimerExpedition($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $expeditions = new Application_Model_DbTable_Expedition();
            $this->view->expedition = $expeditions->obtenirExpedition($id);
        }
    }

}

