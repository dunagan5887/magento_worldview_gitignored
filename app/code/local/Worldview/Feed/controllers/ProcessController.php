<?php

/**
 * Author: Sean Dunagan
 * Created: 4/11/15
 *
 * Class Worldview_Feed_ProcessController
 */

class Worldview_Feed_ProcessController extends Mage_Adminhtml_Controller_Action
{
    // TODO implement acl for this controller
    public function articleRetrievalAction()
    {

        // Redirect to the articles grid page
        return $this->_redirect('worldview_article/index/index');
    }
}
