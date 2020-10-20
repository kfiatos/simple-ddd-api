<?php

declare(strict_types=1);

namespace App\Products\Domain\Dto;

use Symfony\Component\HttpFoundation\Request;

class NewProductDto
{
    protected string $name;

    protected float $price;

    protected ?string $priceCurrency;

    /**
     * NewProductDto constructor.
     * @param string $name
     * @param float $price
     * @param string|null $priceCurrency
     */
    public function __construct(string $name, float $price, ?string $priceCurrency)
    {
        $this->name = $name;
        $this->price = $price;
        $this->priceCurrency = $priceCurrency;
    }

    public static function createFromCreateProductRequest(Request $request): self
    {
        return new self(
            $request->request->get('name'),
            (float)$request->request->get('price'),
            $request->request->get('currency')
        );
    }

    public function toArray(): array
    {
        return
            [
                'name' => $this->getName(),
                'price' => $this->getPrice(),
                'price_currency' => $this->getPriceCurrency()
            ];
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
     * @return string|null
     */
    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }



}