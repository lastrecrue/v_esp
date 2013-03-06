<?php

require_once 'elements/FileUploaderElement.php';

class Application_Form_Multimedia extends Zend_Form {

    public function init() {
        $this->setName('multimedia');
        $id = new Zend_Form_Element_Hidden('idmultimedia');
        $id->addFilter('Int');

        $label = new Zend_Dojo_Form_Element_TextBox('label');
        $label->setLabel('Label')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $idtype = new Zend_Dojo_Form_Element_FilteringSelect('type_idtype');
        $idtype->setLabel('Type Multimedia')
                ->setAutoComplete(true)
                ->setStoreId('typeStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '../type/typelist'))
                ->setAttrib("searchAttr", "label");
        // ->setRequired(true);

        $file = new Zend_Form_Element_File('path');
        $file->setLabel('Element Multimeda');
        $file->setAttrib('data-dojo-type', 'dojox.form.Uploader');
        
        //->setRequired(true);

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $label, $idtype, $file, $envoyer));
    }

}

