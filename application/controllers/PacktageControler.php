<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PacktageControler
 *
 * @author GVLJ3568
 */
class PacktageControler extends Zend_Controller_Action {

    public function packtagelistAction() {
        $packtages = new Application_Model_DbTable_Packtage();
        $select = $packtages->select()->from('packtage', array('idpacktage', 'label'));
        $result = $packtages->getAdapter()->query($select)->fetchAll();
        $data = new Zend_Dojo_Data('idpacktage', $result);
        $this->_helper->autoCompleteDojo($data);
    }

}
