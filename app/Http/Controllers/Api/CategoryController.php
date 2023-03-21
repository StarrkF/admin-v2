<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\PageType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::with('page_type')->get();
            return $this->successResponse(CategoryResource::collection($categories));
        } catch (\Throwable $th) {
            return $this->errorResponse();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->name,
                'number' => $request->number,
                'page_type_id' => $request->page_type_id,
            ]);

            return $this->createdResponse($category);
        } catch (\Throwable $th) {
            return $this->errorResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->successResponse($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $update = $category->update([
            'name' => $request->name,
            'slug' => $request->name,
            'number' => $request->number,
            'page_type_id' => $request->page_type_id,
        ]);

        return $update ? $this->successResponse($category) : $this->errorResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $delete = $category->delete();
        return $delete ? $this->successResponse('Category deleted successfully!') : $this->errorResponse('Category could not deleted successfully!');
    }

    public function getTypes()
    {
       return $this->successResponse(PageType::get());
    }
}
