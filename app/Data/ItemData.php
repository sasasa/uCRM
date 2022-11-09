<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ItemData extends Data
{
    public function __construct(
        public int $id,
        public int $quantity,
    ) {
    }

    public static function rules(): array
    {
        return [
            'id' => ['required', 'regex:/^[0-9]+$/i'],
            'quantity' => ['required', 'min:1'],
        ]; 
    }
}
