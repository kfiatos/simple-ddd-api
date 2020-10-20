<?php

namespace App\Products\Infastructure\Persistence;

use App\Products\Infastructure\Persistence\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductDoctrineRepository extends ServiceEntityRepository
{
    /**
     * ProductDoctrineRepository constructor.
     *
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $em
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Product::class);

        $this->em = $em;
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }


    public function getLastProductId(): int
    {
        /** @var Product $leastProduct */
        $leastProduct = $this->findOneBy([], ['id' => 'desc']);
        if ($leastProduct === null) {
            return 1;
        }
        return $leastProduct->getId();
    }
}