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


class Decorator_ListShuttle extends Zend_Form_Decorator_Abstract {

//    protected $_format = '<label for="%s">%s</label> <input id="%s" name="%s" type="text" value="%s"/>';
    protected $_id;

    public function __construct($options = null) {
        parent::__construct($options);
    }

    public function render($content) {
        $element = $this->getElement();
        $name = htmlentities($element->getFullyQualifiedName());
        $label = htmlentities($element->getLabel());
        $id = htmlentities($element->getId());
        $value = $element->getValue();

        $sources = $element->getAttrib('source'); //$value->source;
        $destinations = $element->getAttrib('destination'); //$value->destination;
        $markup = "";

        $markup = $markup . "<dt><label for=\"label\" class=\"dndLabelCss\">" . $label . "</label></dt>";
        $markup = $markup . "<dd class=\"dndCss\">";
        $markup = $markup . "<div dojoType=\"dojo.dnd.Source\" id=source class=\"dndSourceCss\">";
        if ($sources) {
            foreach ($sources as $personneS) {
                $markup = $markup . $this->getDivByPersonne($personneS);
            }
        }
        $markup = $markup . "</div>";
        $markup = $markup . "<div dojoType=\"dojo.dnd.Source\" id=destination class=\"dndDestCss\">";
        if ($destinations) {
            foreach ($destinations as $personneD) {
                $markup = $markup . $this->getDivByPersonne($personneD);
            }
        }
        $markup = $markup . "</div></dd>";
        return sprintf($markup);
    }

    private function getDivByPersonne($personne) {
        $id = $personne['idpersonne'];
        $nom = $personne['nom'];
        $result = "<div class=\"dojoDndItem\" dndData=\"" . $id . "\">" . $nom . "</div>";
        return $result;
    }

}

