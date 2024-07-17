<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoryModels;

class CategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = categoryModels::orderBy('id', 'DESC')->get();
        return view('admins.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'parent_id' => 'required',



            ],
            [
                'slug.unique' => 'Tên danh mục đã có ,xin điền tên khác',
                'name.unique' => 'Slug danh mục đã có ,xin điền slug khác',
                'name.required' => 'Tên danh mục phải có nhé',


            ]
        );
        $category = new categoryModels();
        $category->name = $data['name'];
        $category->parent_id = $data['parent_id'];

        $category->slug = $data['slug'];

        $category->save();
        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = categoryModels::find($id);
        return view('admins.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'parent_id' => 'required',



            ],
            [
                'slug.unique' => 'Tên danh mục đã có ,xin điền tên khác',
                'name.unique' => 'Slug danh mục đã có ,xin điền slug khác',
                'name.required' => 'Tên danh mục phải có nhé',


            ]
        );
        $category = categoryModels::find($id);
        $category->name = $data['name'];
        $category->parent_id = $data['parent_id'];

        $category->slug = $data['slug'];

        $category->save();
        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        categoryModels::find($id)->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công.');
    }
}
