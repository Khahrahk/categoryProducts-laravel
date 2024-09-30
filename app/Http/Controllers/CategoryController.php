<?php

namespace App\Http\Controllers;

use App\Actions\Categories\Listing;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    public function index(){
        return view('category.index');
    }

    public function show(Request $request){
        $category = Category::find($request->id);
        return view('category.show', compact('category'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            $category = Category::find($validated['id']);
            $category->update([
                'name' => $validated['name'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function store(CategoryStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Category::create([
                "name" => $validated["name"],
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
            $category = Category::find($request->id);
            $category->products->each->delete();
            $category->delete();
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    /**
     * Category paginated list
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @group Categories
     * @queryParam start int Value to start from. Defaults to 1. Example: 1
     * @queryParam page int Page number. Defaults to 1. Example: 1
     * @queryParam length int Page length. Defaults to 10. Example: 10
     */
    public function categoryList(Request $request): JsonResponse
    {
        $result = (new Listing($request))->get();
        return response()->json($result);
    }
}
