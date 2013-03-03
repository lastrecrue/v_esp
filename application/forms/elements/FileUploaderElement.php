<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FileUploaderDecorator.php';

class Element_FileUploader extends Zend_Form_Element {

//    protected $_format = '<label for="%s">%s</label> <input id="%s" name="%s" type="text" value="%s"/>';

    public function __construct($spec, $options = null) {
        parent::__construct($spec, $options);
        $decorator = new Decorator_FileUploader();

        $this->setDecorators(array($decorator));
    }

}
