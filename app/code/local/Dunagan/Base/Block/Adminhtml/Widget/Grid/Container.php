<?php
/**
 * Author: Sean Dunagan
 * Created: 04/06/2015
 *
 * Class Dunagan_Base_Block_Adminhtml_Widget_Grid_Container
 *
 * This class expects the controller to a descendant of class Worldview_Base_Controller_Adminhtml_Abstract
 */

class Dunagan_Base_Block_Adminhtml_Widget_Grid_Container
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $controllerAction = $this->getAction();
        $module_groupname = $controllerAction->getModuleGroupname();
        $module_instance_description = $controllerAction->getModuleInstanceDescription();

        $this->_blockGroup = $module_groupname;
        $this->_controller = $controllerAction->getIndexBlockName();
        $this->_headerText = Mage::helper($module_groupname)->__($module_instance_description);
        parent::__construct();
    }
}
