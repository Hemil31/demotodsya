<?php

namespace App;

use App\Models\SubCategory;

trait CommonFunctions
{
    public function formatOrderItems(array $orderItems)
    {

        $newOrderItems = [];
        $totalQty = 0;
        $totalPrice = 0;
        foreach ($orderItems as $subCategoryId) {
            $subCategory = SubCategory::find($subCategoryId[0]);
            $newOrderItems[] = [
                'id' => $subCategoryId[0],
                'sub_category' => $subCategory->name_i18n[app()->getLocale()] ?? $subCategory->name,
                'qty' => $subCategoryId[1],
                'price' => $subCategoryId[2],
            ];
            $totalQty += $subCategoryId[1];
            $totalPrice += $subCategoryId[2];
        }
        return [
            'order_id_with_qty' => $newOrderItems,
            'total_qty' => $totalQty,
            'total_price' => $totalPrice
        ];
    }
}
