<?php
/**
 * Author: Sean Dunagan
 * Date: 4/9/15
 * Class Worldview_Feed_Helper_Article_Persister_Base
 */

class Worldview_Feed_Helper_Article_Persister_Base
    extends Dunagan_Base_Model_Delegate_Abstract
    implements Dunagan_Base_Model_Delegate_Interface
{

    /**
     * MUST be sure not to load an article which we have already loaded into the database
     *
     * // If an article with the same link already exists in the database, don't record it again
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
     *
     */
}
