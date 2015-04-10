<?php
/**
 * Author: Sean Dunagan
 * Created: 4/6/15
 * Class Worldview_Article_Block_Adminhtml_Source_Container_Grid
 */

class Worldview_Article_Block_Adminhtml_Article_Index_Grid
    extends Dunagan_Base_Block_Adminhtml_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('worldview_article/article')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('source', array(
            'header'    => $this->_getTranslationHelper()->__('Source'),
            'width'     => '25',
            'align'     => 'left',
            'index'     => 'source.name',
            'type'      => 'text'
        ));

        $this->addColumn('title', array(
            'header'    => $this->_getTranslationHelper()->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
            'type'      => 'text'
        ));

        $this->addColumn('article_text', array(
            'header'    => $this->_getTranslationHelper()->__('Article Text'),
            'align'     => 'left',
            'index'     => 'article_text',
            'type'      => 'text'
        ));

        $this->addColumn('created_at', array(
            'header'    => $this->_getTranslationHelper()->__('Created At'),
            'width'     => '30',
            'align'     => 'left',
            'index'     => 'created_at',
            'type'      => 'datetime'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('channel' => $row->getId()));
    }
}
