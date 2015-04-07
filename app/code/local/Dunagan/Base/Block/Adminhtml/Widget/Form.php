<?php
/**
 * Author: Sean Dunagan
 * Created: 4/7/15
 *
 * class Dunagan_Base_Block_Adminhtml_Widget_Form
 */

abstract class Dunagan_Base_Block_Adminhtml_Widget_Form
    extends Mage_Adminhtml_Block_Widget_Form
    implements Dunagan_Base_Block_Adminhtml_Widget_Form_Interface
{
    abstract public function populateFormFieldset(Varien_Data_Form_Element_Fieldset $fieldset);

    protected $_objectToEdit = null;

    protected function _construct()
    {
        parent::_construct();

        $controllerAction = $this->getAction();
        $this->_objectToEdit = $controllerAction->getObjectToEdit();
    }

    protected function _prepareForm()
    {
        $controllerAction = $this->getAction();
        $form_element_id = $controllerAction->getObjectParamName() .'_edit_form';
        $groupname = $controllerAction->getModuleGroupname();

        $helper = Mage::helper($groupname);

        $form = new Varien_Data_Form(array('id' => $form_element_id, 'action' => $this->getActionUrl(), 'method' => 'post'));
        $form->setUseContainer(true);
        $html_id_prefix = $groupname . '_';
        $form->setHtmlIdPrefix($html_id_prefix);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            array('legend' => $helper->__($controllerAction->getObjectDescription()), 'class'=>'fieldset-wide')
        );

        $object_id_element_name = $controllerAction->getObjectParamName();

        $object_id = $this->isObjectBeingEdited() ? $this->getObjectToEdit()->getId() : '';
        $fieldset->addField($object_id_element_name, 'hidden', array(
            'name' => $object_id_element_name,
            'value' => $object_id
        ));

        $this->_populateFormFieldset($fieldset);

        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getActionUrl()
    {
        $uri_path = $this->getAction()->getUriPathForAction('save');
        return $this->getUrl($uri_path);
    }

    public function isObjectBeingEdited()
    {
        return (is_object($this->_objectToEdit) && $this->_objectToEdit->getId());
    }

    // Allow this value to be cached locally so we don't need to keep grabbing it from the controller
    public function getObjectToEdit()
    {
        return $this->_objectToEdit;
    }
}
