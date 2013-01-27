<?php

class Application_Form_Douare extends Zend_Form {

    public function init() {
        $this->setName('commune');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $label = new Zend_Dojo_Form_Element_TextBox('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $nom = new Zend_Dojo_Form_Element_TextBox('nom');
        $nom->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $gps_alt = new Zend_Dojo_Form_Element_TextBox('gps_alt');
        $gps_alt->setLabel('Gps alt')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $gps_lan = new Zend_Dojo_Form_Element_TextBox('gps_lan');
        $gps_lan->setLabel('Gps lan')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
       
        $idcommune = new Zend_Dojo_Form_Element_TextBox('idcommune');
        $idcommune->setLabel('Commune')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer',array('type'=>'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $label, $nom, $gps_alt, $gps_lan, $idcommune,$envoyer));
    }

}

