<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function __construct($application) {
        parent::__construct($application);
        $view = new Zend_View();
    $view->doctype('XHTML1_STRICT');
    $view->navigation = array();
    $view->subnavigation = array();


    $view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper'); 
    $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer(); 
    $viewRenderer->setView($view);
    Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }
}



