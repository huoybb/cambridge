<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/11
 * Time: 19:07
 */

namespace core;

use Goutte\Client;
abstract class myParser
{
    protected $crawler;

    /**
     * serialParser constructor.
     * @param $crawler
     */
    public function __construct($url)
    {
        $this->crawler = $this->getCrawler($url);
    }
    abstract public function parse();
    /**
     * @param $url
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function getCrawler($url)
    {
        $client  = new Client();
        //下面两行，避免了SSL的验证，在正式的web环境中已经设置了，但在命令行中可以直接取消掉验证
        $httpClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setClient($httpClient);

        $crawler = $client->request('get',$url);
        return $crawler;
    }

}