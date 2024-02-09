<?php

namespace App\Services;

class SkuGeneratorService
{
    public static function generateProductSku(string $productName, string $categoryId): string
    {
        $productNamePrefix = substr(strtoupper($productName), 0, 3);

        $uniqueIdentifier = uniqid();

        $sku = $categoryId.'-'.$productNamePrefix.'-'.$uniqueIdentifier;

        return $sku;
    }

    public static function generateVariantSku(string $productName, string $variantAttribute): string
    {
        $productNamePrefix = substr(strtoupper($productName), 0, 3);

        $uniqueIdentifier = uniqid();

        $sku = $productNamePrefix.'-'.$variantAttribute.'-'.$uniqueIdentifier;

        return $sku;
    }
}
