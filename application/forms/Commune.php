<?php



class Application_Form_Commune extends Zend_Form {

    public function init() {
        
        
        $this->setName('commune');

        $id = new Zend_Form_Element_Hidden('idcommune');
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

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer',array('type'=>'submit'));
        $envoyer->setAttrib('idcommune', 'boutonenvoyer');

        $this->addElements(array($id, $nom, $label, $envoyer));
    }

}

