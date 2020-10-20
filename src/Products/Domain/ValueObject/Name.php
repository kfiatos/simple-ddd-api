<?php

declare(strict_types=1);

namespace App\Products\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

final class Name extends StringValueObject
{
    const MIN_NAME_LENGTH = 3;

    public function __construct(string $value)
    {
        if (strlen($value) < self::MIN_NAME_LENGTH) {
            throw new \InvalidArgumentException('Product name should be at least ' . self::MIN_NAME_LENGTH . ' characters long.');
        }
        parent::__construct($value);
    }
}