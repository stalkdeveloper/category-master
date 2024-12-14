<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\CategoryRequest;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        abort_if(Gate::denies('has_permission', 'category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $dataTable->render('admin.categories.index');
        } catch (\Exceptions $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'errors' => 'Oops, something went wrong.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('has_permission', 'category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            try {
                //$categories = Category::whereNull('parent_id')->get();
                $categories = Category::all()->sortBy('full_path');
                $viewHTML = view('admin.categories.create', compact('categories'))->render();
                return response()->json(['success' => true, 'htmlView'=>$viewHTML]);
            } catch (\Exception $e) {
                Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                return response()->json(['status' => 'error', 'message' => 'Error fetching parent categories.'], 500);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        abort_if(Gate::denies('has_permission', 'category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $validator = $request->validated();
            Category::create($validator);
            return response()->json(['success' => true, 'message' => 'Category added successfully!', 'data' => null]);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json(['status' => 'error', 'message' => 'Error fetching parent categories.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        abort_if(Gate::denies('has_permission', 'category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()) {
            try {
                $category = Category::findOrFail($id);
                $categories = Category::where('id', '!=', $category->id)->get()->sortBy('full_path');
                $viewHTML = view('admin.categories.edit', compact('category', 'categories'))->render();
                return response()->json(['success' => true, 'htmlView'=>$viewHTML]);
            } catch (\Exception $e) {
                Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
                return response()->json(['status' => 'error', 'message' => 'Error fetching parent categories.'], 500);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        abort_if(Gate::denies('has_permission', 'category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $validated = $request->validated();
            $category = Category::findOrFail($id);
            $category->update($validated);
            return response()->json(['success' => true, 'message' => 'Category updated successfully!', 'data' => null]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error updating category.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(Gate::denies('has_permission', 'category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $category = Category::findOrFail($id);
            $parentCategory = $category->parent;
            $category->children()->update(['parent_id' => $parentCategory ? $parentCategory->id : null]);
            $category->delete();
            return response()->json(['success' => true, 'message' => 'Category deleted successfully!', 'data' => $id]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error deleting category.'], 500);
        }
    }

    public function toggleStatus($categoryId)
    {
        abort_if(Gate::denies('has_permission', 'category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $category = Category::findOrFail($categoryId);
            $category->status = ($category->status === '1') ? '2' : '1';
            $category->save();

            return response()->json([
                'status' => $category->status,
                'message' => $category->status === '1' ? 'Category enabled successfully.' : 'Category disabled successfully.'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
