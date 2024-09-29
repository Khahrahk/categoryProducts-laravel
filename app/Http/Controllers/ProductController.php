<?php

namespace App\Http\Controllers;

use App\Actions\Products\Listing;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    public function index()
    {
        return view('product.index');
    }

    public function update(ProductUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            $product = Product::find($validated['id']);
            $product->update([
                'name' => $validated['name'],
                "category_id" => $validated["category_id"],
                'description' => $validated['description'],
                'price' => $validated['price'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Product::create([
                "name" => $validated["name"],
                "category_id" => $validated["category_id"],
                'description' => $validated['description'],
                'price' => $validated['price'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $product = Product::find($request->id);
            $product->delete();
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    /**
     * Product paginated list
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @group Product
     * @queryParam start int Value to start from. Defaults to 1. Example: 1
     * @queryParam page int Page number. Defaults to 1. Example: 1
     * @queryParam length int Page length. Defaults to 10. Example: 10
     */
    public function productList(Request $request): JsonResponse
    {
        $result = (new Listing($request))->get();
        return response()->json($result);
    }
}
