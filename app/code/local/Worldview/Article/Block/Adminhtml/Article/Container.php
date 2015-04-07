<?php
/**
 * Author: Sean Dunagan
 * Created: 4/6/15
 * Class Worldview_Article_Block_Adminhtml_Source_Container
 */

class Worldview_Article_Block_Adminhtml_Article_Container
    extends Dunagan_Base_Block_Adminhtml_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        // Don't want to allow for the addition of sources via admin panel at this time
        $this->_removeButton('add');
    }
}
