<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 8:19 PM
 */
class Worldview_Feed_Process_Model_Cron
{
    public function cronRetrieveArticlesFromFeed()
    {
        Mage::helper('worldview_feed_process/retrieval_processor')->retrieveFeedArticles();
    }
}
