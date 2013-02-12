<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimpleInput
 *
 * @author GVLJ3568
 */
//
//<div style="float: left">
//    <div dojoType="dojo.dnd.Source" id=source1 style="float: left">
//        <div class="dojoDndItem" dndData="A">Item 1</div>
//        <div class="dojoDndItem" dndData="B">Item 2</div>
//    </div>
//    <div dojoType="dojo.dnd.Source" id=source2 style="float: left">
//        <div class="dojoDndItem" dndData="C">Item 3</div>
//        <div class="dojoDndItem" dndData="D">Item 4</div>
//        <div class="dojoDndItem" dndData="E">Item 5</div>
//        <div class="dojoDndItem" dndData="F">Item 6</div>
//    </div>
//</div>

require_once 'ListShuttleDecorator.php';

class Element_ListShuttle extends Zend_Form_Element {

//    protected $_format = '<label for="%s">%s</label> <input id="%s" name="%s" type="text" value="%s"/>';

    public function __construct($spec, $options = null) {
        parent::__construct($spec, $options);
        $decorator = new Decorator_ListShuttle();

        $this->setDecorators(array($decorator));
    }

}

