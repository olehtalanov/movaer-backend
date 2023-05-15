<?php

namespace App\Data;

use App\Enums\DeliveryCategoryEnum;
use App\Models\Wish;
use Spatie\LaravelData\{Data, Optional};
use Spatie\LaravelData\Attributes\MapOutputName;

class OrderData extends Data
{
    #[MapOutputName('goods_number')]
    public int $pieces;

    #[MapOutputName('goods_weight')]
    public ?int $weight;

    #[MapOutputName('goods_type')]
    public ?int $goods;

    public ?string $message;

    #[MapOutputName('address_from')]
    public string $locationFrom;

    #[MapOutputName('address_to')]
    public string $locationTo;

    #[MapOutputName('pickup_at')]
    public string $dateFrom;

    #[MapOutputName('delivery_at')]
    public string $dateTo;

    #[MapOutputName('pickup_location_type')]
    public int $selectLocationFrom;

    #[MapOutputName('delivery_location_type')]
    public int $selectLocationTo;

    #[MapOutputName('category')]
    public DeliveryCategoryEnum $categoryName;

    public OrderDetailsData|Optional $details;

    public function __construct(
        string $category,
    )
    {
        $this->categoryName = DeliveryCategoryEnum::fromRequest($category);
    }
}