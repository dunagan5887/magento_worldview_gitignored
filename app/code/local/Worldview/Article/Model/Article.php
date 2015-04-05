<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 7:37 PM
 */
class Worldview_Article_Model_Article extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('worldview_article/article');
    }
}
