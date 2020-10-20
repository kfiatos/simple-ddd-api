<?php

declare(strict_types=1);

namespace App\Products\Infastructure\Persistence\Entity;
use Doctrine\ORM;

class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="int")
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type='string')
     */
    private string $name;

    /**
     * @ORM\Column(type='int')
     */
    private int $price;

    /**
     * @ORM\Column(type='string')
     */
    private string $priceCurrency;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    /**
     * @param string $priceCurrency
     */
    public function setPriceCurrency(string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }
}