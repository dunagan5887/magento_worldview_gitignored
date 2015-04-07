<?php

/**
 * Author: Sean Dunagan
 * Created: 04/06/2015
 * Class Worldview_Base_Block_Adminhtml_Widget_Grid
 */

class Dunagan_Base_Block_Adminhtml_Widget_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_translationHelper = null;

    public function __construct()
    {
        parent::__construct();
        $controllerAction = $this->getAction();
        $grid_id = $controllerAction->getModuleClassname() . '_' . $controllerAction->getModuleInstance();

        $this->setId($grid_id);
        $this->setUseAjax(false);
        $this->setSaveParametersInSession(true);
    }

    protected function _getTranslationHelper()
    {
        if (is_null($this->_translationHelper))
        {
            $controllerAction = $this->getAction();
            $module_classname = $controllerAction->getModuleClassname();
            $this->_translationHelper = Mage::helper($module_classname);
        }

        return $this->_translationHelper;
    }
}
