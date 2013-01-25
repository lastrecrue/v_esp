<?php

class Application_Form_Expedition extends Zend_Form {

    public function init() {
        $this->setName('Expedition');

        $id = new Zend_Form_Element_Hidden('idexpedition');
        $id->addFilter('Int');

        $label = new Zend_Form_Element_Text('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $date_init = new Zend_Form_Element_Text('date_init');
        $date_init->setLabel('Date initiale')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');


        $date_reel = new Zend_Form_Element_Text('date_reel');
        $date_reel->setLabel('Date reel')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');

        $nb_famille = new Zend_Form_Element_Text('nb_famille');
        $nb_famille->setLabel('Nb Famille')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addFilter('Int');

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('idexpedition', 'boutonenvoyer');

        $this->addElements(array($id, $label, $date_init, $date_reel, $nb_famille, $envoyer));
    }

}

