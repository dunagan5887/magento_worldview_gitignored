<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 8:19 PM
 */
class Worldview_Feed_Model_Cron
{
    public function cronRetrieveArticlesFromFeed()
    {
        Mage::helper('worldview_feed/retrieval_processor')->retrieveFeedArticles();
    }
}
