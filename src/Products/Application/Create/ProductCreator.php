<?php

namespace App\Products\Application\Create;

use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepository;
use App\Products\Domain\ValueObject\Name;
use App\Products\Domain\ValueObject\Price;

final class ProductCreator
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductCreator constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(string $name, float $price, string $priceCurrency): Product
    {
        $id = $this->productRepository->getNextId();
        $name = new Name($name);
        $price = new Price($price, $priceCurrency);

        return new Product($id, $name, $price);
    }

    public function store(Product $product)
    {
        $this->productRepository->save($product);
    }

}