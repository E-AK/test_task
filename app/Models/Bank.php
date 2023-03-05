<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Money;

class Bank extends Asset
{
    /**
     * Название банка
     *
     * @var string
     */
    public $bank_name;

    /**
     * Номер счета
     *
     * @var string
     */
    public $bank_account_number;

    /**
     * Деньги в банке
     *
     * @var Money
     */
    public $money;

    function __construct(string $name, string $bank_name, string $bank_account_number, Money $money) {
        $this->type = "bank";

        $this->name = $name;
        $this->bank_name = $bank_name;
        $this->bank_account_number = $bank_account_number;
        $this->money = $money;
    }
}
