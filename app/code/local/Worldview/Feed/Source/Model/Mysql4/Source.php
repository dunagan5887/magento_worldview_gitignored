<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 9:36 PM
 */
class Worldview_Feed_Source_Model_Mysql4_Source
    extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('worldview_feed_source/source', 'entity_id');
    }
}
