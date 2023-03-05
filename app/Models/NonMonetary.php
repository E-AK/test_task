<?php

namespace App\Models;

use App\Models\Asset;

class NonMonetary extends Asset
{
    /**
     * Инвентарный номер
     *
     * @var string
     */
    public $inventory_number;

    /**
     * Дата производства
     *
     * @var string
     */
    public $date_of_manufacture;

    /**
     * Количество
     *
     * @var int
     */
    public $count;

    /**
     * Единица измерения
     *
     * @var string
     */
    public $unit;

    /**
     * Единица измерения
     *
     * @var string
     */
    public $currency;

    /**
     * Начальная стоимость
     *
     * @var Money
     */
    public $initial_cost;

    /**
     * Остаточная стоимость
     *
     * @var Money
     */
    public $residual_value;

    /**
     * Оценочная стоимость
     *
     * @var Money
     */
    public $assessed_value;

    function __construct(string $name, string $inventory_number, string $date_of_manufacture, int $count, string $unit, string $currency, int $units_initial_cost, int $nano_initial_cost, int $units_residual_value, int $nano_residual_value, int $units_assessed_value, int $nano_assessed_value) {
        $this->type = "non_monetary";

        $this->name = $name;
        $this->inventory_number = $inventory_number;
        $this->date_of_manufacture = $date_of_manufacture;
        $this->count = $count;
        $this->unit = $unit;
        $this->currency = $currency;
        $this->initial_cost = new Money($currency, $units_initial_cost, $nano_initial_cost);
        $this->residual_value = new Money($currency, $units_residual_value, $nano_residual_value);
        $this->assessed_value = new Money($currency, $units_assessed_value, $nano_assessed_value);
    }

    
}
