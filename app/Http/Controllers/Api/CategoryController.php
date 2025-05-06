<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categorys = Category::select('id', 'name', 'name_i18n')
                ->where('status', '1')
                ->with([
                    'subCategories' => function ($query) {
                        $query->select('id', 'category_id', 'name', 'name_i18n', 'image')
                            ->where('status', '1');
                    }
                ])
                ->get()
                ->map(fn($category) => [
                    'id' => $category->id,
                    'name' => $category->name_i18n[$this->locale] ?? $category->name,
                    'sub_categories' => $category->subCategories->map(fn($sub) => [
                        'id' => $sub->id,
                        'name' => $sub->name_i18n[$this->locale] ?? $sub->name,
                        'image' => $sub->image?? 'demo.png',
                    ]),
                ]);
            return $this->success($categorys, 'Categorys retrieved successfully.');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve categories.', [], 500);
        }
    }
}
