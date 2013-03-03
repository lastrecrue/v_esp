<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Decorator_FileUploader extends Zend_Form_Decorator_Abstract {

    protected $_id;

    public function __construct($options = null) {
        parent::__construct($options);
    }

    public function render($content) {
        $element = $this->getElement();
        $name = htmlentities($element->getFullyQualifiedName());
        $label = htmlentities($element->getLabel());
        $id = htmlentities($element->getId());
        
        $markup = "<div id=\"".$id."\"class=\"dndCss\">";
        $markup = $markup . "<label for=\"label\" >".$label."</label><br/>";      
        $markup = $markup . "<input name=\"".$name."ibraUploadComposant\" multiple=\"false\" type=\"file\" "
                . "data-dojo-type=\"dojox.form.Uploader\" class=\"uploaderElementCss\" "
                . " label=\"".$label."ibraUploadComposant\" id=\"".$id."ibraUploadComposant\" />";
   
       
//        echo $markup;
        return sprintf($markup);
    }

}
