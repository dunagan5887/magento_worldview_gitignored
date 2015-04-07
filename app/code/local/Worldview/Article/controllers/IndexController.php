<?php

/**
 * Author: Sean Dunagan
 * Created: 04/06/2015
 * Class Worldview_Article_IndexController
 */

class Worldview_Article_IndexController extends Dunagan_Base_Controller_Adminhtml_Abstract
{
    public function getModuleClassname()
    {
        return 'worldview_article';
    }

    public function getModuleInstance()
    {
        return 'article';
    }

    public function getModuleInstanceDescription()
    {
        return 'Articles';
    }

    public function getBlockName()
    {
        return 'adminhtml_article_container';
    }
} 