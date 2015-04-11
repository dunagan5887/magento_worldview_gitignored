<?php
/**
 * Author: Sean Dunagan
 * Created: 4/10/15
 */

abstract class Worldview_Source_Helper_Raw_Data_Processor_Abstract
    implements Worldview_Source_Helper_Raw_Data_Processor_Interface
{
    protected $_base_conversion_array = array(
        Worldview_Source_Helper_Data::TITLE_WORLDVIEW_APP_FIELD => Worldview_Source_Helper_Data::TITLE_FEED_FIELD,
        Worldview_Source_Helper_Data::LINK_WORLDVIEW_APP_FIELD => Worldview_Source_Helper_Data::LINK_FEED_FIELD,
        Worldview_Source_Helper_Data::DESCRIPTION_WORLDVIEW_APP_FIELD => Worldview_Source_Helper_Data::DESCRIPTION_FEED_FIELD,
        Worldview_Source_Helper_Data::PUBLICATION_DATE_WORLDVIEW_APP_FIELD => Worldview_Source_Helper_Data::PUBLICATION_DATE_FEED_FIELD,
        Worldview_Source_Helper_Data::ARTICLE_TEXT_WORLDVIEW_APP_FIELD => Worldview_Source_Helper_Data::SCRAPED_ARTICLE_TEXT_FEED_FIELD,
    );

    /**
     * Should contain an array mapping fields that this application operates on mapped to
     * the fields which are expected to be returned by the feed in the raw data response
     *
     * @return mixed
     */
    abstract public function getFieldConversionArray();

    abstract public function scrapeArticleData(array $raw_article_data);

    public function processRawArticleData(array $raw_feed_source_article_set)
    {
        $field_conversion_array = $this->getFieldConversionArray();
        $processed_article_data_array = array();

        foreach ($raw_feed_source_article_set as $index => $raw_article_data)
        {
            $processed_article_data = array();

            $scraped_article_text = $this->scrapeArticleData($raw_article_data);
            $raw_article_data[Worldview_Source_Helper_Data::SCRAPED_ARTICLE_TEXT_FEED_FIELD] = $scraped_article_text;

            foreach ($field_conversion_array as $application_field => $raw_data_field)
            {
                $processed_article_data[$application_field] =
                    isset($raw_article_data[$raw_data_field]) ? $raw_article_data[$raw_data_field] : '';
            }

            $processed_article_data_array[$index] = $processed_article_data;
        }

        return $processed_article_data_array;
    }
}
