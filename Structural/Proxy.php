<?php

/// Subject - субъект

/// определяет общий для Math и "Proxy" интерфейс, так что класс
/// "Proxy" можно использовать везде, где ожидается
interface IMath
{
    function Add($x, $y);
    function Sub($x, $y);
    function Mul($x, $y);
    function Div($x, $y);
}



/// RealSubject - реальный объект
/// определяет реальный объект, представленный заместителем

class Math implements IMath
{
    public function __construct()
    {
        print ("Create object Math. Wait...");
        sleep(5);
    }

    public function  Add($x, $y){return $x + $y;}
    public function  Sub($x, $y){return $x - $y;}
    public function  Mul($x, $y){return $x * $y;}
    public function  Div($x, $y){return $x / $y;}
}


/// Proxy - заместитель
/// хранит ссылку, которая позволяет заместителю обратиться к реальному
/// субъекту. Объект класса "MathProxy" может обращаться к объекту класса
/// "Math", если интерфейсы классов "Math" и "IMath" одинаковы;
/// предоставляет интерфейс, идентичный интерфейсу "IMath", так что заместитель
/// всегда может быть предоставлен вместо реального субъекта;
/// контролирует доступ к реальному субъекту и может отвечать за его создание
/// и удаление;
/// прочие обязанности зависят от вида заместителя:
/// удаленный заместитель отвечает за кодирование запроса и его аргументов
/// и отправление закодированного запроса реальному субъекту в
/// другом адресном пространстве;
/// виртуальный заместитель может кэшировать дополнительную информацию
/// о реальном субъекте, чтобы отложить его создание.
/// защищающий заместитель проверяет, имеет ли вызывающий объект
/// необходимые для выполнения запроса права;
class MathProxy implements IMath
{
    protected $math;

    public function __construct()
    {
        $this->math = null;
    }
    /// Быстрая операция - не требует реального субъекта
    public function Add($x, $y)
    {
        return $x + $y;
    }

    public function  Sub($x, $y)
    {
        return $x - $y;
    }


    /// Медленная операция - требует создания реального субъекта
    public function Mul($x, $y)
    {
        if ($this->math == null)
            $this->math = new Math();
        return $this->math->Mul($x, $y);
    }

    public function Div($x, $y)
    {
        if ($this->math == null)
            $this->math = new Math();
        return $this->math->Div($x, $y);
    }
}
$p = new MathProxy;

// Do the math
print("4 + 2 = ".$p->Add(4, 2));
print("4 - 2 = ".$p->Sub(4, 2));
print("4 * 2 = ".$p->Mul(4, 2));
print("4 / 2 = ".$p->Div(4, 2));