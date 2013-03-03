<?php

class TypeController extends Zend_Controller_Action
{

    public function init() {
      Zend_Dojo::enableView($this->view);
    }

    public function indexAction() {
        $types = new Application_Model_DbTable_Type();
        $this->view->types = $types->fetchAll();
    }
    public function typelistAction() {
        $types = new Application_Model_DbTable_Type();
        $select = $types->select()->from('type', array('idtype', 'label'));
        $result = $types->getAdapter()->query($select)->fetchAll();
        $data = new Zend_Dojo_Data('idtype', $result);
        $this->_helper->autoCompleteDojo($data);
    }
    public function ajouterAction() {
        $form = new Application_Form_Type();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nom = $form->getValue('nom');
                $label = $form->getValue('label');
                $types = new Application_Model_DbTable_Type();
                $types->ajouterType($label, $nom);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Type();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $label = $form->getValue('label');
                $nom = $form->getValue('nom');
                $types = new Application_Model_DbTable_Type();
                $types->modifierType($id, $label, $nom);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $types = new Application_Model_DbTable_Type();
                $form->populate($types->obtenirType($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $types = new Application_Model_DbTable_Type();
                $types->supprimerType($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $types = new Application_Model_DbTable_Type();
            $this->view->type = $types->obtenirType($id);
        }
    }


}







