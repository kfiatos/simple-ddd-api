<?php

declare(strict_types=1);

namespace App\Products\Domain\ValueObject;

final class Price
{
    protected PriceAmount $amount;

    protected string $currency;

    /**
     * Price constructor.
     *
     * @param int $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency = CurrencyDictionary::PLN)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Amount should be a positive value: {$amount}.");
        }

        if (!in_array($currency, CurrencyDictionary::supportedCurrencies())) {
            throw new \InvalidArgumentException("Currency should be a valid one: {$currency}.");
        }

        $this->amount = new PriceAmount($amount*100);
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount->value()/100;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }



}