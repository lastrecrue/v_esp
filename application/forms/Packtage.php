<?php

class Application_Form_Packtage extends Zend_Form {

    public function init() {
        $this->setName('packtage');
        $id = new Zend_Form_Element_Hidden('idpacktage');
        $id->addFilter('Int');

        $label = new Zend_Dojo_Form_Element_TextBox('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');



        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $label, $envoyer));
    }

}

