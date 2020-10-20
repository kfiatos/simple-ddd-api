<?php

declare(strict_types=1);

namespace App\Products\Domain\ValueObject;

final class CurrencyDictionary
{
    const PLN = 'PLN';
    const USD = 'USD';

    /**
     * @return string[]
     */
    public static function supportedCurrencies(): array
    {
        return [
            self::PLN,
            self::USD
        ];
    }
}