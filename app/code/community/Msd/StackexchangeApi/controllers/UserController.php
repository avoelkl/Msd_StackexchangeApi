<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     controllers
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_UserController extends Mage_Core_Controller_Front_Action {

    public function indexAction(){

        $this->loadLayout();
        $this->renderLayout();
    }

    public function listAction(){

        $this->loadLayout();
        $this->renderLayout();
    }

}