<?php
declare(strict_types=1);

namespace App\Products\Application\Create;

class ProductCreateCommand
{
    private string $name;

    private float $price;

    private string $priceCurrency;

    /**
     * ProductCreateCommand constructor.
     *
     * @param string $name
     * @param float $price
     * @param string $priceCurrency
     */
    public function __construct(string $name, float $price, string $priceCurrency)
    {
        $this->name = $name;
        $this->price = $price;
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }
}