<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 9:36 PM
 */
class Worldview_Source_Model_Source extends Mage_Core_Model_Abstract
{
    const RAW_DATA_PROCESSOR_REQUIRED_INTERFACE = 'Worldview_Source_Helper_Raw_Data_Processor_Interface';
    const RAW_DATA_PROCESSOR_FIELD = 'raw_data_processor';
    const DEFAULT_RAW_DATA_PROCESSOR_CLASSNAME = 'worldview_source/raw_data_processor_default';

    const ERROR_INVALID_RAW_DATA_PROCESSOR = 'Source with code %s has defined its raw data processor to be %s, but this classname does not represent a valid data processor. The raw_data_processor field for a source MUST be a helper which implements interface %s. The default raw data processor will be used.';

    protected $_rawDataProcessor = null;

    public function _construct()
    {
        $this->_init('worldview_source/source');
    }

    public function getRawDataProcessor()
    {
        if (is_null($this->_rawDataProcessor))
        {
            $raw_data_processor_classname = $this->getData(self::RAW_DATA_PROCESSOR_FIELD);

            $rawDataProcessorHelper = Mage::helper($raw_data_processor_classname);

            $raw_data_processor_is_valid = true;
            if (!is_object($rawDataProcessorHelper))
            {
                $raw_data_processor_is_valid = false;
            }
            else
            {
                $raw_data_processor_class_name = get_class($rawDataProcessorHelper);
                $interfaces = class_implements($raw_data_processor_class_name);
                if (!isset($interfaces[self::RAW_DATA_PROCESSOR_REQUIRED_INTERFACE]))
                {
                    $raw_data_processor_is_valid = false;
                }
            }

            if (!$raw_data_processor_is_valid)
            {
                $error_message = sprintf(self::ERROR_INVALID_RAW_DATA_PROCESSOR, $this->getCode(), $raw_data_processor_classname, self::RAW_DATA_PROCESSOR_REQUIRED_INTERFACE);
                Mage::log($error_message);
                $exceptionToLog = new Exception($error_message);
                Mage::logException($exceptionToLog);

                $rawDataProcessorHelper = Mage::helper(self::DEFAULT_RAW_DATA_PROCESSOR_CLASSNAME);
            }

            $this->_rawDataProcessor = $rawDataProcessorHelper;
        }

        return $this->_rawDataProcessor;
    }
}
