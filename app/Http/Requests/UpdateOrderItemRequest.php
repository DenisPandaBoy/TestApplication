<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends CreateOrderItemRequest
{

    public function rules(): array
    {
        $parentRules = parent::rules();
        unset($parentRules['order_id']);
        $parentRules['order_id'] = ['exists:order_items,id'];
        return $parentRules;
    }
}
