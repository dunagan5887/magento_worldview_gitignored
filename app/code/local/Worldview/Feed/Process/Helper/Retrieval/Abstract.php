<?php
/**
 * Author: Sean Dunagan
 * Date: 4/3/15 9:06 PM
 */

abstract class Worldview_Feed_Process_Helper_Retrieval_Abstract
    implements Worldview_Feed_Process_Helper_Retrieval_Interface
{
    protected $_article_classname;

    abstract public function produceArticleCollectionFromFeedSource(Worldview_Feed_Source_Model_Interface $feedSource);

    public function produceArticleObjectByUrl($page_url, Worldview_Feed_Source_Model_Interface $feedSource)
    {
        $articleScraperModel = $feedSource->getArticleScraperModel();

        $article_text = $articleScraperModel->getScrapedTextByUrl($page_url);

        if (empty($article_text))
        {
            return null;
        }

        $articleConversionModel = $this->getArticleConversionModel();

        $article = $articleConversionModel->convertItemToArticle($article_text, $feedSource);
        if (!is_object($article))
        {
            return null;
        }

        $article->save();

        return $article;
    }

    public function getArticleClassname()
    {
        return $this->_article_classname;
    }

    public function setArticleClassname($article_classname)
    {
        $this->_article_classname = $article_classname;
        return $this;
    }
}
