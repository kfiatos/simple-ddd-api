<?php

namespace App\Products\Infastructure\Persistence;

use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepository;
use App\Products\Domain\ValueObject\Id;

class MysqlProductRepository implements ProductRepository
{
    protected ProductDoctrineRepository $productDoctrineRepository;

    /**
     * MysqlProductRepository constructor.
     * @param ProductDoctrineRepository $productDoctrineRepository
     */
    public function __construct(ProductDoctrineRepository $productDoctrineRepository)
    {
        $this->productDoctrineRepository = $productDoctrineRepository;
    }

    public function save(Product $product): void
    {
        $productEntity = new Entity\Product();
        $productEntity->setId($product->getId()->value());
        $productEntity->setName($product->getName());
        $productEntity->setPrice($product->getPrice()->getAmount());
        $productEntity->setPriceCurrency($product->getPrice()->getCurrency());

        $this->productDoctrineRepository->save($productEntity);
    }

    public function getNextId(): Id
    {
        $currentNewestId = $this->productDoctrineRepository->getLastProductId();

        return new Id($currentNewestId + 1);
    }

    public function findLastCreated(): ?Entity\Product
    {
        return $this->productDoctrineRepository->findOneBy([], ['id' => 'desc']);
    }

}