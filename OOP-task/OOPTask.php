<?php
error_reporting(E_ERROR | E_PARSE);

abstract class TrashUnit
{
    abstract function getPrice();
    abstract function getName();
    abstract function getCount();
    abstract function getMainMaterial();
}

interface TaxCollector
{
    public function getSellingTax($percentValue);
    public function getNettoPrice($percentValue);
}

trait TrashComeInformer
{
    public function trashComeInformer()
    {
        echo "A new heap of recyclable trash is here again!";
    }
}

class BeerCans extends TrashUnit implements TaxCollector
{
    use TrashComeInformer;
    private $count;
    private $price;
    public function __construct($count = 0, $price = 0)
    {
        $this->count = $count;
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->count * $this->price;
    }

    public function getSellingTax($percentValue = 5)
    {
        return $this->getPrice() * ($percentValue / 100.0);
    }

    public function getNettoPrice($percentValue = 5)
    {
        return $this->getPrice() - $this->getSellingTax($percentValue);
    }

    public function getMainMaterial()
    {
        return "Aluminium";
    }

    public function getName()
    {
        return "Beer Bottles";
    }

    public function getCount()
    {
        return $this->count;
    }
}

$testCans = new BeerCans(10, 5);
$percents = 5;
echo $testCans->trashComeInformer();
echo "<br>" . "<br>";
echo "Type: " . $testCans->getName() . "<br>";
echo "Amount: " . $testCans->getCount() . "<br>";
echo "Main Material: " . $testCans->getMainMaterial() . "<br>";
echo "Brutto Reward: " . $testCans->getPrice() . "<br>";
echo "Tax Interest Rate: " . $percents . "%" . "<br>";
echo "Netto Reward: " . $testCans->getNettoPrice($percents);
