<?php
/**
 * Author: Sean Dunagan
 * Created: 4/4/15 5:50 PM
 */

$sources_to_add_array = array(
    'cnn_world' => array(
        'active' => 1,
        'name' => 'CNN World News Feed',
        'feed_url' => 'http://rss.cnn.com/rss/cnn_world.rss',
        'category' => 'World',
        'type' => 'RSS'
    ),
    'fox_news_world' => array(
        'active' => 1,
        'name' => 'Fox News World News Feed',
        'feed_url' => 'http://feeds.foxnews.com/foxnews/world',
        'category' => 'World',
        'type' => 'RSS'
    ),
    'msnbc_world' => array(
        'active' => 1,
        'name' => 'MSNBC World News Feed',
        'feed_url' => 'http://feeds.nbcnews.com/feeds/worldnews',
        'category' => 'World',
        'type' => 'RSS'
    ),
    'huffington_post_world' => array(
        'active' => 1,
        'name' => 'Huffington Post World News Feed',
        'feed_url' => 'http://www.huffingtonpost.com/feeds/verticals/world/index.xml',
        'category' => 'World',
        'type' => 'RSS'
    ),
    'usa_today_world' => array(
        'active' => 1,
        'name' => 'USA Today World News Feed',
        'feed_url' => 'http://rssfeeds.usatoday.com/UsatodaycomWorld-TopStories',
        'category' => 'World',
        'type' => 'RSS'
    ),
);

foreach ($sources_to_add_array as $source_code => $source_data_array)
{
    $sourceToAdd = Mage::getModel('worldview_source/source')
                    ->setCode($source_code)
                    ->addData($source_data_array);

    $sourceToAdd->save();
}
