<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 8:21 PM
 */
class Worldview_Feed_Process_Helper_Processor
{
    const RETRIEVAL_PROCESS_CLASSNAMES_CONFIG = 'worldview_feed_process/article_retrieval';

    public function retrieveFeedArticles()
    {
        $feedProcesses = $this->getAllFeedRetrievalProcesses();

        foreach ($feedProcesses as $feedProcess)
        {
            $feedSources = $feedProcess->getAllFeedSources();

            foreach ($feedSources as $feedSource)
            {
                $articleCollection = $feedProcess->produceArticleCollectionFromFeedSource($feedSource);
                $this->logArticlesRetrievedFromFeed($articleCollection, $feedSource);
            }
        }
    }

    public function logArticlesRetrievedFromFeed(Worldview_Feed_Source_Model_Mysql4_Source_Collection $articleCollection,
                                                    Worldview_Feed_Source_Model_Source $feedSource)
    {

    }

    public function getAllFeedRetrievalProcesses()
    {
        $retrieval_process_classnames = Mage::getStoreConfig(self::RETRIEVAL_PROCESS_CLASSNAMES_CONFIG);
        $retrieval_process_array = array();

        foreach ($retrieval_process_classnames as $retrieval_process_classname)
        {
            $processRetrievalHelper = Mage::helper($retrieval_process_classname);
            $retrieval_process_array[] = $processRetrievalHelper;
        }

        return $retrieval_process_array;
    }
}
