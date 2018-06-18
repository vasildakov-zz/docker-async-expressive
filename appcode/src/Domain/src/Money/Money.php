<?php

namespace Domain\Money;

class Money implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $amount;
    /**
     * @var Currency
     */
    private $currency;

    public function __construct($amount, $currency)
    {
        if (!is_int($amount)) {
            throw new \InvalidArgumentException('$amount must be an integer');
        }
        $this->amount   = $amount;
        $this->currency = new Currency($currency);
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param Money $other
     * @return int
     */
    public function compareTo(Money $other) : int
    {
        // $this->assertSameCurrency($this, $other);
        if ($this->amount == $other->getAmount()) {
            return 0;
        }
        return $this->amount < $other->getAmount() ? -1 : 1;
    }

    /**
     * @param Money $other
     * @return bool
     */
    public function equals(Money $other) : bool
    {
        return $this->compareTo($other) == 0;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'amount'   => $this->amount,
            'currency' => $this->currency->getCurrencyCode()
        ];
    }
}
