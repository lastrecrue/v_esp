<?php

class Application_Form_Multimedia extends Zend_Form {

    public function init() {
        $this->setName('multimedia');
        $id = new Zend_Form_Element_Hidden('idmultimedia');
        $id->addFilter('Int');
        
        $idtype = new Zend_Dojo_Form_Element_FilteringSelect('idtype');
        $idtype->setLabel('Type Multimedia')
                ->setAutoComplete(true)
                ->setStoreId('typeStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '/v_esp/public/type/typelist'))
                ->setAttrib("searchAttr", "label")
                ->setRequired(true);
        



        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($id, $idtype, $envoyer));
    }

}

