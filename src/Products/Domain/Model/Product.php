<?php

declare(strict_types=1);

namespace App\Products\Domain\Model;

use App\Products\Domain\ValueObject\Id;
use App\Products\Domain\ValueObject\Name;
use App\Products\Domain\ValueObject\Price;

final class Product
{

    private Id $id;

    private Name $name;

    private Price $price;

    /**
     * Product constructor.
     *
     * @param Id $id
     * @param Name $name
     * @param Price $price
     */
    public function __construct(Id $id, Name $name, Price $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

        public function getId(): Id
    {
        return $this->id;
    }

        public function getName(): Name
    {
        return $this->name;
    }

        public function getPrice(): Price
    {
        return $this->price;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'price' => $this->getPrice()->getAmount(),
            'price_currency' => $this->getPrice()->getCurrency()
        ];
    }
}