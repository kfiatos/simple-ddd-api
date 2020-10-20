<?php

namespace App\Products\Application\Find;

use App\Products\Domain\Model\Product;
use App\Products\Domain\ValueObject\Id;
use App\Products\Domain\ValueObject\Name;
use App\Products\Domain\ValueObject\Price;
use App\Products\Infastructure\Exception\ProductNotFoundException;
use App\Products\Infastructure\Persistence\MysqlProductRepository;

class ProductFinder
{
    protected MysqlProductRepository $repository;

    /**
     * ProductFinder constructor.
     *
     * @param MysqlProductRepository $repository
     */
    public function __construct(MysqlProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Product|null
     *
     * @throws ProductNotFoundException
     */
    public function findLastCreated(): Product
    {
        /** @var \App\Products\Infastructure\Persistence\Entity\Product $entity */
        $entity =  $this->repository->findLastCreated();

        if ($entity === null) {
            throw new ProductNotFoundException('Product not found in database');
        }
        $id = new Id($entity->getId());
        $name = new Name($entity->getName());
        $price = new Price($entity->getPrice(), $entity->getPriceCurrency());

        return new Product($id, $name, $price);
    }
}