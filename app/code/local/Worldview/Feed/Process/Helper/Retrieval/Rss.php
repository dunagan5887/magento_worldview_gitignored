<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 6:48 PM
 */
class Worldview_Feed_Process_Helper_Retrieval_Rss
    extends Worldview_Feed_Process_Helper_Retrieval_Abstract
    implements Worldview_Feed_Process_Helper_Retrieval_Interface
{
    const EXCEPTION_PRODUCING_FEED = "An exception occurred while attempting to produce article collection from source with code %s: %s";

    public function getAllFeedSources()
    {
        $feedSourceCollection = Mage::getModel('worldview_feed_source/source')
                                    ->getCollection()
                                    ->addFieldToFilter('type', 'rss');

        return $feedSourceCollection;
    }

    /**
     * @param Worldview_Feed_Source_Model_Interface $feedSource
     * @return Worldview_Article_Model_Mysql4_Article_Collection
     * @throws Exception
     */
    public function produceArticleCollectionFromFeedSource(Worldview_Feed_Source_Model_Interface $feedSource)
    {
        try
        {
            $article_model_classname = $this->getArticleClassname();
            $articleCollection = Mage::getModel($article_model_classname)->getCollection();

            $rss_url = $feedSource->getRssUrl();
            $rss_xml_object = simplexml_load_file($rss_url);

            if (!is_object($rss_xml_object) || !is_object($rss_xml_object->channel))
            {
                return $articleCollection;
            }

            foreach($rss_xml_object->channel->item as $item)
            {
                // Ensure that the $item object contains a link
                if (!isset($item->link) || empty($item->link))
                {
                    continue;
                }

                // Ensure that the $item object contains a title before querying to see if this article has already been retrieved
                if (!isset($item->title) || empty($item->title))
                {
                    continue;
                }

                // If an article with the same link already exists in the database, don't record it again
                $article_link = $item->link;
                $previouslyRetrievedArticle = Mage::getModel($this->getArticleClassname())
                                                ->getCollection()
                                                ->addFieldToFilter('source_url', $article_link)
                                                ->getFirstItem();

                if (is_object($previouslyRetrievedArticle) && $previouslyRetrievedArticle->getId())
                {
                    // Do not retrieve this article again
                    continue;
                }

                $article = $this->produceArticleObjectByUrl($article_link, $feedSource);
                $articleCollection->addItem($article);
            }
        }
        catch(Exception $e)
        {
            $error_message = sprintf(self::EXCEPTION_PRODUCING_FEED, $feedSource->getSourceCode());
            throw new Exception($error_message);
        }

        return $articleCollection;
    }
}
