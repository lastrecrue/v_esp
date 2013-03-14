<?php

require_once 'elements/ListShuttleElement.php';

class Application_Form_Expedition extends Zend_Form {

    public function init() {
        Zend_Dojo::enableForm($this);

        $this->setName('Expedition');
        $id = new Zend_Form_Element_Hidden('idexpedition');
        $id->addFilter('Int');

        $label = new Zend_Dojo_Form_Element_TextBox('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $date_init = new Zend_Dojo_Form_Element_DateTextBox('date_init');
        $date_init->setLabel('Date initiale');
        $date_reel = new Zend_Dojo_Form_Element_DateTextBox('date_reel');
        $date_reel->setLabel('Date reel');

        $nb_famille = new Zend_Dojo_Form_Element_TextBox('nb_famille');
        $nb_famille->setLabel('Nb Famille')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addFilter('Int');




        $idpacktage = new Zend_Dojo_Form_Element_FilteringSelect('idpacktage');
        $idpacktage->setLabel('Packtage')
                ->setAutoComplete(true)
                ->setStoreId('packtageStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '../packtage/packtagelist'))
                ->setAttrib("searchAttr", "label");
        $idexp = $this->getAttrib('id');


        $element = $this->initDnd($idexp);

// array('onclick' => 'loadData();')
//        array('type' => 'submit')
        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('onclick' => 'submitPersonnesBenevoleAction();'));
        $envoyer->setAttrib('idexpedition', 'boutonenvoyer');

        $this->addElements(array($id, $label, $date_init, $date_reel, $nb_famille, $idpacktage, $element, $envoyer));
    }

    public function initDnd($idexp) {
        $source = $this->getPersonneSource($idexp);
        $destination = $this->getPersonneDest($idexp);
        $element = new Element_ListShuttle('Benevole');
        $element->setLabel('Benevole : ');
        $element->setAttribs(array('source' => $source, 'destination' => $destination));

        return $element;
    }

    private function getPersonneDest($id) {
        $personne = new Application_Model_DbTable_Personne();
        if ($id != 0) {
            $destination = $personne->getPersonneInExpedition($id);
        } else {
            $destination = false;
        }
        return $destination;
    }

    private function getPersonneSource($id) {
        $personne = new Application_Model_DbTable_Personne();
        if ($id != 0) {
            $source = $personne->getPersonneNotInExpedition($id);
        } else {
            $source = $personne->fetchAll();
        }
        return $source;
    }

}

