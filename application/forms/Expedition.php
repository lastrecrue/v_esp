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
        
        
        $idpacktage = new Zend_Dojo_Form_Element_FilteringSelect('$idpacktage');
        $idpacktage->setLabel('Packtage')
                ->setAutoComplete(true)
                ->setStoreId('packtageStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '/v_esp/public/packtage/packtagelist'))
                ->setAttrib("searchAttr", "label")
                ->setRequired(true);

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer',array('type'=>'submit'));
        $envoyer->setAttrib('idexpedition', 'boutonenvoyer');

        $this->addElements(array($id, $label, $date_init, $date_reel, $nb_famille, $envoyer));
    }

    public function initDnd($id,$source, $destination) {
        
        
        $label = new Zend_Dojo_Form_Element_TextBox('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $label->setValue($id);

        $this->setName('Expedition Personne');
        $id = new Zend_Form_Element_Hidden('idexpedition');
        $id->addFilter('Int');
        
        $element = new Element_ListShuttle('dgdBenevole');
        $element->setLabel('Benevole : ');
        $element->setAttribs(array('source' => $source, 'destination' => $destination));

        

        $this->addElements(array($element,$label));
    }

}

