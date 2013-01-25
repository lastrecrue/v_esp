<?php

class Application_Form_Commune extends Zend_Form
{

    public function init()
    {
         $this->setName('commune');

        $id = new Zend_Form_Element_Hidden('idcommune');
        $id->addFilter('Int');

        $label = new Zend_Form_Element_Text('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('idcommune', 'boutonenvoyer');

        $this->addElements(array($id, $nom, $label, $envoyer));
    }


}

