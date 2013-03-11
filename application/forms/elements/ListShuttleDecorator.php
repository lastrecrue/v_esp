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

        $markup = "<div id=\"" . $id . "name=\"" . $name . "\" \"class=\"dndCss\">";
        $markup = $markup . "<label for=\"label\" class=\"dndLabelCss\">" . $label . "</label>";
        $markup = $markup . "<div dojoType=\"dojo.dnd.Source\" id=source class=\"dndSourceCss\">";
//        var_dump($sources);
        if ($sources) {
            foreach ($sources as $personneS) {
//            var_dump($personne);
                $markup = $markup . "<div class=\"dojoDndItem\" dndData=\"" . $personneS['idpersonne'] . "\">" . $personneS['nom'] . "</div>";
            }
        }
        $markup = $markup . "</div>";
        $markup = $markup . "<div dojoType=\"dojo.dnd.Source\" id=destination class=\"dndDestCss\">";
        if ($destinations) {
            foreach ($destinations as $personneD) {
                $markup = $markup . "<div class=\"dojoDndItem\" dndData=\"" . $personneD['idpersonne'] . "\">" . $personneD['nom'] . "</div>";
            }
        }
        $markup = $markup . "</div>";
        $markup = $markup . "</div>";
//        $markup = sprintf($this->_format, $name, $label, $id, $name, $value);
//        echo $markup;
        return sprintf($markup);
    }

}

