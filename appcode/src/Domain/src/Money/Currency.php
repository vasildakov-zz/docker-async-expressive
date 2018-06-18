<?php

namespace Domain\Money;

class Currency
{
    /**
     * @var array
     */
    private static $currencies = [
        'EUR' => [
            'display_name' => 'Euro',
            'numeric_code' => 978,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
        ],
        'GBP' => [
            'display_name' => 'Pound Sterling',
            'numeric_code' => 826,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
        ],
        'USD' => [
            'display_name' => 'US Dollar',
            'numeric_code' => 840,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
        ],
    ];

    /**
     * @var string
     */
    private $currencyCode;


    /**
     * @param  string $currencyCode
     * @throws \InvalidArgumentException
     */
    public function __construct($currencyCode)
    {
        if (!isset(self::$currencies[$currencyCode])) {
            $currencyCode = strtoupper($currencyCode);
        }
        if (!isset(self::$currencies[$currencyCode])) {
            throw new \InvalidArgumentException(
                sprintf('Unknown currency code "%s"', $currencyCode)
            );
        }
        $this->currencyCode = $currencyCode;
    }

    /**
     * Returns the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Returns the name that is suitable for displaying this currency.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return self::$currencies[$this->currencyCode]['display_name'];
    }

    /**
     * Returns the ISO 4217 numeric code of this currency.
     *
     * @return integer
     */
    public function getNumericCode()
    {
        return self::$currencies[$this->currencyCode]['numeric_code'];
    }

    /**
     * Returns the ISO 4217 numeric code of this currency.
     *
     * @return integer
     */
    public function getSubUnit()
    {
        return self::$currencies[$this->currencyCode]['sub_unit'];
    }

    /**
     * Returns the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->currencyCode;
    }

}
