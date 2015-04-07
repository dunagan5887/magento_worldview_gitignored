<?php

class Worldview_Source_IndexController extends Dunagan_Base_Controller_Adminhtml_Abstract
{
    public function getModuleClassname()
    {
        return 'worldview_source';
    }

    public function getModuleInstance()
    {
        return 'source';
    }

    public function getModuleInstanceDescription()
    {
        return 'Feed Sources';
    }

    public function getBlockName()
    {
        return 'adminhtml_source_container';
    }
} 