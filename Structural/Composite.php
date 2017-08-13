<?php

/**
 * Component - компонент
 * объявляет интерфейс для компонуемых объектов;
 * предоставляет подходящую реализацию операций по умолчанию,
 * общую для всех классов;
 * объявляет интерфейс для доступа к потомкам и управлению ими;
 * определяет интерфейс доступа к родителю компонента в рекурсивной структуре
 * и при необходимости реализует его. Описанная возможность необязательна;
 */
abstract class Component
{
    protected $name;

    // Constructor
    public function __construct($name)
    {
        $this->name = $name;
    }

    public abstract function add(Component $c);
    public abstract function remove(Component $c);
    public abstract function display();
}

/**
 * Composite - составной объект
 * определяет поведение компонентов, у которых есть потомки;
 * хранит компоненты-потомоки;
 * реализует относящиеся к управлению потомками операции и интерфейс
 */
class Composite extends Component
{
    private $children = array();

    public function add(Component $component)
    {
        $this->children[$component->name] = $component;
    }

    public function remove(Component $component)
    {
        unset($this->children[$component->name]);
    }

    public function display()
    {
        foreach($this->children as $child)
            $child->display();
    }
}

/**
 * Leaf - лист
 * представляет листовой узел композиции и не имеет потомков;
 * определяет поведение примитивных объектов в композиции;
 */
class Leaf extends Component
{

    public function add(Component $c)
    {
        print ("Cannot add to a leaf");
    }

    public function remove(Component $c)
    {
        print("Cannot remove from a leaf");
    }

    public function display()
    {
        print_r($this->name);
    }
}

// Create a tree structure
$root = new Composite("root");

$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");

$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));
$root->add($comp);
$root->add(new Leaf("Leaf C"));

// Add and remove a leaf
$leaf = new Leaf("Leaf D");
$root->add($leaf);
$root->remove($leaf);

// Recursively display tree
$root->display();