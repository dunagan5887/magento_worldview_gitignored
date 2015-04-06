<?php


class Worldview_Source_Block_Adminhtml_Source_Container
    extends Worldview_Base_Block_Adminhtml_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        // Don't want to allow for the addition of sources via admin panel at this time
        $this->_removeButton('add');
    }
}
