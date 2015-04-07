<?php

class Worldview_Source_IndexController
    extends Dunagan_Base_Controller_Adminhtml_Form_Abstract
    implements Dunagan_Base_Controller_Adminhtml_Form_Interface
{
    public function getModuleGroupname()
    {
        return 'worldview_source';
    }

    public function getControllerActiveMenuPath()
    {
        return 'worldview/feeds/sources';
    }

    public function getModuleInstanceDescription()
    {
        return 'Feed Sources';
    }

    public function getIndexBlockName()
    {
        return 'adminhtml_source_index';
    }

    public function getObjectParamName()
    {
        return 'source';
    }

    public function getObjectDescription()
    {
        return 'Feed Source';
    }

    public function getModuleInstance()
    {
        return 'source';
    }

    public function getFormBlockName()
    {
        return 'adminhtml_source';
    }

    public function getFormActionsController()
    {
        return 'index';
    }
}
