<?php

abstract class AbstractComponent
{
    abstract public function operation();
}

class ConcreteComponent extends AbstractComponent
{
    public function operation()
    {
        // ...
    }
}

abstract class AbstractDecorator extends AbstractComponent
{
    protected $_component;

    public function __construct(AbstractComponent $component)
    {
        $this->_component = $component;
    }
}

class ConcreteDecorator extends AbstractDecorator
{
    public function operation()
    {
        // ... расширенная функциональность ...
        $this->_component->operation();
        // ... расширенная функциональность ...
    }
}

$decoratedComponent = new ConcreteDecorator(
    new ConcreteComponent()
);

$decoratedComponent->operation();
