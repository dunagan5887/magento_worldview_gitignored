<?php
/**
 * Author: Sean Dunagan
 * Created: 4/7/15
 *
 * class Dunagan_Base_Controller_Adminhtml_Form_Abstract
 *
 * NOTE:  It is expected that the block used to render the form container for these actions will descend from
 *          Dunagan_Base_Block_Adminhtml_Widget_Form_Container
 */

abstract class Dunagan_Base_Controller_Adminhtml_Form_Abstract
    extends Dunagan_Base_Controller_Adminhtml_Abstract
    implements Dunagan_Base_Controller_Adminhtml_Form_Interface
{
    const ERROR_INVALID_OBJECT_ID = 'No object with classname %s and id %s was found in the database.';

    // Documentation for these abstract classes is given in Dunagan_Base_Controller_Adminhtml_Form_Interface
    abstract public function getObjectParamName();

    abstract public function getObjectDescription();

    abstract public function getModuleInstance();

    abstract public function getFormBlockName();

    abstract public function getFormActionsController();

    // This class will set this field. It's accessor is given below as getObjectToEdit()
    protected $_objectToEdit = null;

    public function editAction()
    {
        $objectToEdit = $this->_initializeObjectFromParam();
        $object_id = $this->getRequest()->getParam($this->getObjectParamName());

        $existing_object_was_returned = (is_object($objectToEdit) && $objectToEdit->getId());
        $user_is_adding_a_new_object = empty($object_id);

        if ($existing_object_was_returned || $user_is_adding_a_new_object)
        {
            // NOTE: It is expected that the block used to render the form container for these actions will descend from
            //    Dunagan_Base_Block_Adminhtml_Widget_Form_Container
            $block_to_create_classname = $this->getModuleGroupname() . '/' . $this->getFormBlockName() . '_edit';
            $blockToCreate = $this->getLayout()->createBlock($block_to_create_classname);
            $block_to_create_name_in_layout = $this->getModuleGroupname() . '_' . $this->getModuleInstance() . '_edit';
            $blockToCreate->setNameInLayout($block_to_create_name_in_layout);

            $object_description = $this->getObjectDescription();
            if ($user_is_adding_a_new_object)
            {
                // No id was passed in, user is attempting to create a new object
                $page_title_template = 'Add New %';
                $page_title = sprintf($page_title_template, $object_description);
            }
            else
            {
                // An existing object was found with $object_id
                $this->_objectToEdit = $objectToEdit;
                $page_title_template = 'Edit Existing %s with id %s';
                $page_title = sprintf($page_title_template, $object_description, $object_id);
            }

            $blockToCreate->setPageTitleToRender($page_title);

            $this->_setSetupTitle($this->__($page_title));

            $this->loadLayout()->_addContent($blockToCreate);
            $this->renderLayout();
        }
        else
        {
            // An object's id was passed in, but no existing entity with that id was found
            $object_classname = $this->_getObjectClassname();
            $error_message = sprintf(self::ERROR_INVALID_OBJECT_ID, $object_classname, $object_id);
            $this->_getSession()->addError(Mage::helper($this->getModuleGroupname())->__($error_message));
            $this->_redirect('*/*/index');
        }
    }

    protected function _initializeObjectFromParam()
    {
        $object_id = $this->getRequest()->getParam($this->getObjectParamName());
        if ($object_id)
        {
            $object_classname = $this->_getObjectClassname();
            $objectToInitialize = Mage::getModel($object_classname)
                                    ->load($object_id);
            if ($objectToInitialize->getId())
            {
                return $objectToInitialize;
            }
        }
        return false;
    }

    protected function _getObjectClassname()
    {
        $objects_module_instance = $this->getModuleInstance();
        $objects_module = $this->getModuleGroupname();
        $object_classname = $objects_module . '/' . $objects_module_instance;

        return $object_classname;
    }

    public function getUriPathForAction($action)
    {
        $uri_path = sprintf('%s/%s/%s', $this->getModuleGroupname(), $this->getFormActionsController(), $action);
        return $uri_path;
    }

    public function getFormBackControllerActionPath()
    {
        return 'index/index';
    }
    
    public function getObjectToEdit()
    {
        return $this->_objectToEdit;
    }
}
