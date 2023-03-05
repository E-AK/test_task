<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Money;
use App\Models\NonMonetary;
use App\Models\Ticket;

class AssetController extends Controller
{
    /**
     * Название актива
     */
    private static $assets;

    public function __construct()
    {
        self::$assets = [
            new Bank("Счет в банке ЕвроВорБанк", "EвроВорБанк", "5", new Money("RUB", 1000, 0)), 
            new Bank("Счет в банке Внешторгбанк", "Внешторгбанк", "3", new Money("USD", 5, 0)),
            new Cash("Деньги в кассе", new Money("RUB", 100, 0)),
            new Ticket("Талоны на бензин в кассе Аспека", new Money("RUB", 1000, 0), 3),
            new NonMonetary(
                "Торговое здание по адресу Бассейная-6", 
                "7", 
                "1970", 
                1, 
                "шт.",
                'RUB',
                3000,
                0, 
                5000,
                0, 
                1000000,
                0
            ),
            new NonMonetary(
                "Гвозди", 
                "", 
                "2000", 
                100, 
                "кг.",
                'RUB',
                1000,
                0, 
                100,
                0, 
                2000,
                0
            )
        ];
    }

    public function create(Request $asset)
    {
        switch($asset->input("type")) {
            case "bank":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $bank = new Bank(
                    $asset->input("name"), 
                    $asset->input("bank_name"), 
                    $asset->input("bank_account_number"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    )
                );
                array_push(self::$assets, $bank);
                break;
            case "cash":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $cash = new Cash(
                    $asset->input("name"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    )
                );
                array_push(self::$assets, $cash);
                break;
            case "ticket":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $ticket = new Ticket(
                    $asset->input("name"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    ),
                    $asset->input("unit")
                );
                array_push(self::$assets, $ticket);
                break;
            case "non_monetary":
                if($asset->input("nano_initial_cost") || 
                $asset->input("units_residual_value") || 
                $asset->input("nano_residual_value") || 
                $asset->input("units_assessed_value") ||
                $asset->input("nano_assessed_value")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $non_monetary = new NonMonetary(
                    $asset->input("name"), 
                    $asset->input("inventory_number"), 
                    $asset->input("date_of_manufacture"), 
                    $asset->input("count"),
                    $asset->input("unit"),
                    $asset->input("currency"),
                    $asset->input("units_initial_cost"),
                    $asset->input("nano_initial_cost"),
                    $asset->input("units_residual_value"),
                    $asset->input("nano_residual_value"),
                    $asset->input("units_assessed_value"),
                    $asset->input("nano_assessed_value")
                );
                array_push(self::$assets, $non_monetary);
                break;
        }

        $assets = array_values(self::$assets);

        return view('assets', compact('assets'));
    }

    public function get_all()
    {
        $assets = self::$assets;

        return view('assets', compact('assets'));
    }

    public function update(int $id, Request $asset)
    {
        switch($asset->input("type")) {
            case "bank":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $bank = new Bank(
                    $asset->input("name"), 
                    $asset->input("bank_name"), 
                    $asset->input("bank_account_number"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    )
                );
                self::$assets[$id] = $bank;
                break;
            case "cash":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $cash = new Cash(
                    $asset->input("name"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    )
                );
                self::$assets[$id] = $cash;
                break;
            case "ticket":
                if($asset->input("units") || $asset->input("nano")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $ticket = new Ticket(
                    $asset->input("name"), 
                    new Money(
                        $asset->input("currency"),
                        $asset->input("units"),
                        $asset->input("nano")
                    ),
                    $asset->input("unit")
                );
                self::$assets[$id] = $ticket;
                break;
            case "non_monetary":
                if($asset->input("nano_initial_cost") || 
                $asset->input("units_residual_value") || 
                $asset->input("nano_residual_value") || 
                $asset->input("units_assessed_value") ||
                $asset->input("nano_assessed_value")) {
                    return response()->json([
                        'message' => 'Number cannot be negative'
                    ], 412);
                }

                $non_monetary = new NonMonetary(
                    $asset->input("name"), 
                    $asset->input("inventory_number"), 
                    $asset->input("date_of_manufacture"), 
                    $asset->input("count"),
                    $asset->input("unit"),
                    $asset->input("currency"),
                    $asset->input("units_initial_cost"),
                    $asset->input("nano_initial_cost"),
                    $asset->input("units_residual_value"),
                    $asset->input("nano_residual_value"),
                    $asset->input("units_assessed_value"),
                    $asset->input("nano_assessed_value")
                );
                self::$assets[$id] = $non_monetary;
                break;
        }

        $assets = self::$assets;

        return view('assets', compact('assets'));
    }

    public function delete(string $id)
    {
        unset(self::$assets[$id]);

        $assets = array_values(self::$assets);

        return view('assets', compact('assets'));
    }
}
