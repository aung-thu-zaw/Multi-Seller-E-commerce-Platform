<?php

namespace App\Services;

use App\Models\BlogContent;
use App\Models\BlogTag;
use App\Models\Option;
use App\Models\ProductVariant;

class HandleProductVariantOptionService
{
    /**
     * @param  array<string>  $options
     */
    public function handle(array $options, ProductVariant $productVariant): void
    {
        $filteredOptions = array_unique(array_map('strtolower', $options));

        $attachedOptionIds = $productVariant->options()->pluck('id')->toArray();

        foreach ($filteredOptions as $option) {
            $existedOption = Option::where('name', $option)->first();

            if (!$existedOption) {
                $optionModel = Option::create(['name' => $option]);

                $productVariant->options()->attach($optionModel);
            } elseif (!in_array($existedOption->id, $attachedOptionIds)) {
                $productVariant->options()->attach($existedOption);
            }
        }
    }
}
