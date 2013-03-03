<?php

class Application_Form_Personne extends Zend_Form {

    public function init() {
        $this->setName('commune');

        $id = new Zend_Form_Element_Hidden('idpersonne');
        $id->addFilter('Int');



        $nom = new Zend_Dojo_Form_Element_TextBox('nom');
        $nom->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $prenom = new Zend_Dojo_Form_Element_TextBox('prenom');
        $prenom->setLabel('Prenom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $date_naissance = new Zend_Dojo_Form_Element_DateTextBox('date_naissance');
        $date_naissance->setLabel('Date naissance')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $adresse = new Zend_Dojo_Form_Element_TextBox('adresse');
        $adresse->setLabel('Adresse')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $phone = new Zend_Dojo_Form_Element_TextBox('phone');
        $phone->setLabel('Phone')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $mail = new Zend_Dojo_Form_Element_TextBox('mail');
        $mail->setLabel('Mail')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $idcommune = new Zend_Dojo_Form_Element_FilteringSelect('commune_idcommune');
        $idcommune->setLabel('Commune')
                ->setAutoComplete(true)
                ->setStoreId('communeStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '../commune/communelist'))
                ->setAttrib("searchAttr", "label");



        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune, $envoyer));
    }

}

