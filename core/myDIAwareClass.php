<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/16
 * Time: 21:07
 */

namespace core;


use Phalcon\Di\InjectionAwareInterface;

/**
 * Class myDiAwareClass
 * @package core
 *
 * @property myRouter | \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface $router
 * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
 * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
 * @property \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface $response
 * @property \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface $cookies
 * @property \Phalcon\Security $security
 * @property \Phalcon\Flash\Session $flash
 * @property \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface $session
 * @property \Phalcon\Cache\BackendInterface $viewCache
 * @property myAuth auth
 */
abstract class myDIAwareClass implements InjectionAwareInterface
{

    protected $di;
    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
        return $this;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * 魔术方法，将返回Di中的service
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->getDI()->get($property);
    }
}