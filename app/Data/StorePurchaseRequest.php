<?php

namespace App\Data;

use App\Data\ItemData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Carbon\CarbonImmutable;

class StorePurchaseRequest extends Data
{
    public function __construct(
        public string $date,
        public int $customer_id,
        public bool $status,
        /** @var DataCollection<ItemData> */
        public DataCollection $items,
    ) {
    }


    public static function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'customer_id' => ['required'],
            'status' => ['required', 'boolean'],
            'items' => ['required'],
        ];
    }
}
