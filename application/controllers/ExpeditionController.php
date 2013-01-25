<?php

class ExpeditionController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $expeditions = new Application_Model_DbTable_Expedition();
        $this->view->expeditions = $expeditions->fetchAll();
    }

    public function ajouterAction() {
        $form = new Application_Form_Expedition();
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
                }else{
                    $date_reel = new Zend_Date();
                    $date_reel->set('01/01/9999', 'dd/MM/yy');
                }
                $nb_famille = (int) $form->getValue('nb_famille');
                $expeditions = new Application_Model_DbTable_Expedition();

                $expeditions->ajouterExpedition($label, $date_init->toString('YYYY-MM-dd HH:mm:ss'), $date_reel->toString('YYYY-MM-dd HH:mm:ss'), $nb_famille);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function suprimerAction() {
        // action body
    }

    public function modifierAction() {
        // action body
    }

}

