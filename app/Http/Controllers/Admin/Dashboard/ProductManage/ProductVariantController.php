<?php

namespace App\Http\Controllers\Admin\Dashboard\ProductManage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantType;
use App\Models\VariantValue;
use App\Services\SkuGeneratorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductVariantController extends Controller
{
    public function index(Product $product): Response|ResponseFactory
    {
        $product->load(['productVariants.variantValues.variantType']);

        $productVariants = $product->productVariants;
        $variantTypes = $this->extractVariantTypes($productVariants);

        return inertia('Admin/ProductManage/ProductVariants', compact('product', 'productVariants', 'variantTypes'));
    }

    private function extractVariantTypes($productVariants): array
    {
        $variantTypes = [];

        foreach ($productVariants as $productVariant) {
            foreach ($productVariant->variantValues as $variantValue) {
                $variantType = $variantValue->variantType;
                if (! in_array($variantType, $variantTypes, true)) {
                    $variantTypes[] = $variantType;
                }
            }
        }

        return $variantTypes;
    }

    // public function store(Request $request, Product $product): RedirectResponse
    // {
    //     $variantType = VariantType::firstOrCreate(["name" => $request->variant_type]);

    //     foreach ($request->variant_values as $value) {

    //         $variantValue = VariantValue::firstOrCreate([
    //             'variant_type_id' => $variantType->id,
    //             'value' => trim($value),
    //         ]);

    //         // if()

    //         $productVariant = ProductVariant::create([
    //             'product_id' => $product->id,
    //             'sku' => SkuGeneratorService::generateVariantSku($product->name, $variantType->name),
    //             'price' => $product->price,
    //             'qty' => $product->qty,
    //             'offer_price' => $product->offer_price ?? 0,
    //             'offer_price_start_date' => $product->offer_price_start_date,
    //             'offer_price_end_date' => $product->offer_price_end_date,
    //         ]);

    //         // Attach variant values to the product variant through the pivot table
    //         $productVariant->variantValues()->attach($variantValue->id, ['variant_type_id' => $variantType->id]);
    //     }

    //     return back();
    // }

    // public function store(Request $request, Product $product): RedirectResponse
    // {
    //     $variantType = VariantType::firstOrCreate(['name' => $request->variant_type]);

    //     // Retrieve existing product variants for the product
    //     $existingProductVariants = $product->productVariants;

    //     // Retrieve existing variant values for the given variant type
    //     $existingVariantValues = $variantType->variantValues;

    //     foreach ($request->variant_values as $value) {
    //         // Create or retrieve VariantValue instance
    //         $variantValue = VariantValue::firstOrCreate([
    //             'variant_type_id' => $variantType->id,
    //             'value' => trim($value),
    //         ]);

    //         foreach ($existingProductVariants as $existingProductVariant) {
    //             // Check if the product variant with the same variant type already exists
    //             $existingVariant = $existingProductVariant->variantValues()
    //                 ->wherePivot('variant_type_id', $variantType->id)
    //                 ->wherePivot('variant_value_id', $variantValue->id)
    //                 ->exists();

    //             // If not, attach the new variant value to the existing product variant
    //             if (!$existingVariant) {
    //                 $existingProductVariant->variantValues()->attach($variantValue->id, ['variant_type_id' => $variantType->id]);
    //             }
    //         }

    //         // If the variant value does not exist, create a new product variant
    //         if (!$existingVariantValues->contains($variantValue)) {
    //             $newProductVariant = ProductVariant::create([
    //                 'product_id' => $product->id,
    //                 'sku' => SkuGeneratorService::generateVariantSku($product->name, $value),
    //                 'price' => $product->price,
    //                 'qty' => $product->qty,
    //                 'offer_price' => $product->offer_price ?? 0,
    //                 'offer_price_start_date' => $product->offer_price_start_date,
    //                 'offer_price_end_date' => $product->offer_price_end_date,
    //             ]);

    //             // Attach the new variant value to the new product variant through the pivot table
    //             $newProductVariant->variantValues()->attach($variantValue->id, ['variant_type_id' => $variantType->id]);
    //         }
    //     }

    //     return back();
    // }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $variantType = VariantType::firstOrCreate(['name' => $request->variant_type]);

        // Retrieve existing variant values for the given variant type
        $existingVariantValues = $variantType->variantValues;

        // Generate all possible combinations of variant values
        $combinations = $this->generateCombinations($request->variant_values);

        foreach ($combinations as $combination) {
            // Create or retrieve VariantValue instances for each value in the combination
            $variantValues = [];
            foreach ($combination as $value) {
                $variantValue = VariantValue::firstOrCreate([
                    'variant_type_id' => $variantType->id,
                    'value' => trim($value),
                ]);
                $variantValues[] = $variantValue;
            }

            // Check if the product variant with the same combination already exists
            $existingVariant = $this->variantCombinationExists($product, $variantValues);

            // If not, create a new product variant
            if (! $existingVariant) {
                $newProductVariant = ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => SkuGeneratorService::generateVariantSku($product->name, implode('-', $combination)),
                    'price' => $product->price,
                    'qty' => $product->qty,
                    'offer_price' => $product->offer_price ?? 0,
                    'offer_price_start_date' => $product->offer_price_start_date,
                    'offer_price_end_date' => $product->offer_price_end_date,
                ]);

                // Attach the new variant values to the new product variant through the pivot table
                foreach ($variantValues as $variantValue) {
                    $newProductVariant->variantValues()->attach($variantValue->id, ['variant_type_id' => $variantType->id]);
                }
            }
        }

        return back();
    }

    private function generateCombinations($arrays, $i = 0)
    {
        if (! isset($arrays[$i])) {
            return is_array($arrays[$i - 1]) ? [[]] : [];
        }

        $result = [];

        $currentArray = is_array($arrays[$i]) ? $arrays[$i] : [$arrays[$i]];

        $tmp = $this->generateCombinations($arrays, $i + 1);

        foreach ($currentArray as $value) {
            foreach ($tmp as $combination) {
                $result[] = array_merge([$value], $combination);
            }
        }

        return $result;
    }

    private function variantCombinationExists($product, $variantValues)
    {
        foreach ($product->productVariants as $existingProductVariant) {
            $existingValues = $existingProductVariant
                ->variantValues()
                ->wherePivotIn('variant_value_id', array_column($variantValues, 'id'))
                ->pluck('variant_value_id')
                ->toArray();

            if (count($existingValues) === count($variantValues)) {
                return true; // Variant combination already exists
            }
        }

        return false; // Variant combination does not exist
    }
}

// color =red , blue
// size =sm,lg,xl

// color size
// red  sm
// blue sm
// red lg
// blue lg
// red xl
// blue
// x
