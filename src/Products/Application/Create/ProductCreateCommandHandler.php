<?php

namespace App\Products\Application\Create;

class ProductCreateCommandHandler
{
    protected ProductCreator $productCreator;

    /**
     * ProductCreateCommandHandler constructor.
     * @param ProductCreator $productCreator
     */
    public function __construct(ProductCreator $productCreator)
    {
        $this->productCreator = $productCreator;
    }

    public function exectue(ProductCreateCommand $createCommand)
    {
        $product = $this->productCreator->create(
            $createCommand->getName(),
            $createCommand->getPrice(),
            $createCommand->getPriceCurrency()
        );

        $this->productCreator->store($product);
    }
}