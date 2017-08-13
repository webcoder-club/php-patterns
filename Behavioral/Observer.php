<?php

interface Observer
{
    function notify($obj);
}

class ExchangeRate
{
    static private $instance = null;
    private $observers = array();
    private $exchange_rate;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    static public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ExchangeRate();
        }

        return self::$instance;
    }

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate($new_rate)
    {
        $this->exchange_rate = $new_rate;
        $this->notifyObservers();
    }

    public function registerObserver(Observer $obj)
    {
        $this->observers[] = $obj;
    }

    function notifyObservers()
    {
        foreach ($this->observers as $obj) {
            $obj->notify($this);
        }
    }
}

class ProductItem implements Observer
{

    public function __construct()
    {
        ExchangeRate::getInstance()->registerObserver($this);
    }

    public function notify($obj)
    {
        if ($obj instanceof ExchangeRate) {
            print "Received update!\n";
        }
    }
}

$product1 = new ProductItem();
$product2 = new ProductItem();

ExchangeRate::getInstance()->setExchangeRate(4.5);
