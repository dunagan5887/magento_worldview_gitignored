<?php

/**
 * This class expects the controller to a descendant of class Worldview_Base_Controller_Adminhtml_Abstract
 *
 * Class Worldview_Base_Block_Adminhtml_Widget_Grid_Container
 */
class Worldview_Base_Block_Adminhtml_Widget_Grid_Container
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $controllerAction = $this->getAction();
        $module_classname = $controllerAction->getModuleClassname();
        $module_instance_description = $controllerAction->getModuleInstanceDescription();

        $this->_blockGroup = $module_classname;
        $this->_controller = $controllerAction->getBlockName();
        $this->_headerText = Mage::helper($module_classname)->__($module_instance_description);
        parent::__construct();
    }
}
