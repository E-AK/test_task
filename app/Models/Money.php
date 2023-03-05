<?php

namespace App\Models;

class Money
{
    /**
     * Валюта (может быть талоном)
     *
     * @var string
     */
    public $currency;

    /**
     * Целая чать суммы
     *
     * @var int
     */
    public $units;

    /**
     * Дробная часть суммы
     *
     * @var int
     */
    public $nano;

    function __construct(string $currency, int $units, int $nano) {
        $this->currency = $currency;
        $this->units = $units;
        $this->nano = $nano;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
