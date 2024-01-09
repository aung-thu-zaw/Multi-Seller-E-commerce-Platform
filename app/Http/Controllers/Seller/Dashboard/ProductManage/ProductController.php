<?php

namespace App\Http\Controllers\Seller\Dashboard\ProductManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\ProductManage\ProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    use HandlesQueryStringParameters;
    use ImageUpload;

    public function index(): Response|ResponseFactory
    {
        $products = Product::search(request('search'))
            ->where('store_id', Store::getStoreId())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/ProductManage/Products/Index', compact('products'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/ProductManage/Products/Create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        if ($request->attribute_options) {
            foreach ($request->attribute_options as $attributeOption) {
                $attributeName = $attributeOption['attribute'];
                $options = $attributeOption['options'];

                $attribute = Attribute::firstOrCreate(['name' => $attributeName]);

                foreach ($options as $option) {
                    AttributeOption::firstOrCreate([
                        'attribute_id' => $attribute->id,
                        'value' => $option,
                    ]);
                }
            }
        }

        $attributesByName = Attribute::pluck('id', 'name')->toArray();

        DB::transaction(function () use ($request, $attributesByName) {
            $image = isset($request->image) ? $this->createImage($request->image, 'products') : null;

            $product = Product::create([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'store_id' => Store::getStoreId(),
                'name' => $request->name,
                'description' => $request->description,
                // 'code' => $request->code,
                'price' => $request->price,
                'offer_price' => $request->offer_price,
                'offer_price_start_date' => $request->offer_price_start_date,
                'offer_price_end_date' => $request->offer_price_end_date,
                'qty' => $request->qty,
                'image' => $image,
                'warranty_type' => $request->warranty_type,
                'warranty_period' => $request->warranty_period,
                'warranty_policy' => $request->warranty_policy,
                'return_day' => $request->return_day,
                'return_policy' => $request->return_policy,
                'status' => 'pending',
            ]);

            foreach ($request->images as $image) {
                $originalName = $image->getClientOriginalName();

                $fileName = time().'-'.$originalName;

                $image->storeAs('products', $fileName);

                ProductImage::create(['product_id' => $product->id, 'image' => $fileName]);
            }

            if ($request->variants) {
                foreach ($request->variants as $sku) {
                    $skuCode = str($product->name);
                    $skuOptions = [];

                    foreach ($sku['attributes'] as $name => $value) {
                        $skuCode .= ' '.$value.' '.$name;
                        if (! array_key_exists($name, $attributesByName)) {
                            // $this->command->error('Attribute '.$name.' not found');

                            return;
                        }
                        $attributeOption = AttributeOption::where('attribute_id', $attributesByName[$name])
                            ->where('value', $value)
                            ->value('id');
                        if (! $attributeOption) {
                            // $this->command->error('Attribute Value '.$name.' => '.$value.' not found');

                            return;
                        }
                        $skuOptions[] = $attributeOption;
                    }
                    $sku = $product->skus()->create([
                        'code' => str()->slug($skuCode),
                        'price' => $sku['price'],
                        'offer_price' => $sku['offer_price'],
                        'qty' => $sku['qty'],
                    ]);

                    $sku->attributeOptions()->attach($skuOptions);
                }
            }
        });

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Product $product): Response|ResponseFactory
    {
        $product->load(['productImages:id,product_id,image', 'skus.attributeOptions.attribute']);

        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/ProductManage/Products/Edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        dd($request->all());
        // (new UpdateProductAction())->handle($request->validated(), $product);

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::whereIn('id', $selectedItems)->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }
}
