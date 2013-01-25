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
        // action body
    }

    public function supprimerAction() {
        // action body
    }

}

