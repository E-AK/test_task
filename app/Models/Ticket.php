<?php

namespace App\Models;

use App\Models\Money;

class Ticket extends Asset
{
    /**
     * Номинал талона
     *
     * @var Money
     */
    public $money;

    /**
     * Количество
     *
     * @var int
     */
    public $unit;

    function __construct(string $name, Money $money, int $unit) {
        $this->type = "ticket";

        $this->name = $name;
        $this->money = $money;
        $this->unit = $unit;
    }

    
}
