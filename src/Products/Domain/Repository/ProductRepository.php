<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Model\Product;
use App\Products\Domain\ValueObject\Id;

interface ProductRepository
{
    public function getNextId(): Id;

    public function save(Product $product): void;

    public function findLastCreated();
}