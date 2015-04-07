<?php

/**
 * Author: Sean Dunagan
 * Created: 04/06/2015
 * Class Worldview_Article_IndexController
 */

class Worldview_Article_IndexController
    extends Dunagan_Base_Controller_Adminhtml_Abstract
    implements Dunagan_Base_Controller_Adminhtml_Interface
{
    public function getModuleGroupname()
    {
        return 'worldview_article';
    }

    public function getControllerActiveMenuPath()
    {
        return 'worldview/articles/view_articles';
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