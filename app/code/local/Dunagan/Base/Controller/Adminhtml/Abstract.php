<?php
/**
 * Author: Sean Dunagan
 * Created: 04/06/2015
 * Class Worldview_Base_Controller_Adminhtml_Abstract
 */

abstract class Dunagan_Base_Controller_Adminhtml_Abstract extends Mage_Adminhtml_Controller_Action
{
    abstract public function getModuleClassname();

    abstract public function getModuleInstance();

    abstract public function getModuleInstanceDescription();

    abstract public function getBlockName();

    public function indexAction()
    {
        $module_instance = $this->getModuleInstance();
        $module_groupname = $this->getModuleClassname();
        $module_description = $this->getModuleInstanceDescription();
        $module_block_classname = $module_groupname . '/' . $this->getBlockName();

        $this->loadLayout()
            ->_setActiveMenu($module_instance)
            ->_setSetupTitle(Mage::helper($module_groupname)->__($module_description))
            ->_addBreadcrumb()
            ->_addBreadcrumb(Mage::helper($module_groupname)->__($module_description), Mage::helper($module_groupname)->__($module_description))
            ->_addContent($this->getLayout()->createBlock($module_block_classname))
            ->renderLayout();
    }

    protected function _setSetupTitle($title)
    {
        try {
            $this->_title($this->__($this->getModuleInstanceDescription()))
                ->_title($title);
        }
        catch (Exception $e)
        {
            Mage::logException($e);
        }
        return $this;
    }

    protected function _addBreadcrumb($label = null, $title = null, $link=null)
    {
        $module_groupname = $this->getModuleClassname();
        $module_description = $this->getModuleInstanceDescription();

        if (is_null($label))
        {
            $label = Mage::helper($module_groupname)->__($module_description);
        }
        if (is_null($title))
        {
            $title = Mage::helper($module_groupname)->__($module_description);
        }
        return parent::_addBreadcrumb($label, $title, $link);
    }

    protected function _setActiveMenu($menu_name)
    {
        $full_menu_name = $this->getModuleClassname() . '/' . $menu_name;
        return parent::_setActiveMenu($full_menu_name);
    }

    protected function _isAllowed()
    {
        $admin_path = $this->getModuleClassname() . '/' . $this->getModuleInstance();
        return Mage::getSingleton('admin/session')->isAllowed($admin_path);
    }
}
