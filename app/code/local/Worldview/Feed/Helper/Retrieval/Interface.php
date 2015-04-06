<?php
/**
 * Author: Sean Dunagan
 * Date: 4/3/15 9:04 PM
 */

interface Worldview_Feed_Helper_Retrieval_Interface
{
    /**
     * @return Worldview_Feed_Source_Model_Mysql4_Source_Collection
     */
    public function getAllFeedSources();

    /**
     * @param Worldview_Feed_Source_Model_Interface $feedSource
     * @return Worldview_Article_Model_Mysql4_Article_Collection
     * @throws Exception
     */
    public function produceArticleCollectionFromFeedSource(Worldview_Feed_Source_Model_Interface $feedSource);

    public function getArticleClassname();

    public function setArticleClassname($article_classname);
}