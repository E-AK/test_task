<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Money;

class Cash extends Asset
{
    /**
     * Деньги в кассе
     *
     * @var Money
     */
    public $money;

    function __construct(string $name, Money $money) {
        $this->type = "cash";

        $this->name = $name;
        $this->money = $money;
    }

    
}
