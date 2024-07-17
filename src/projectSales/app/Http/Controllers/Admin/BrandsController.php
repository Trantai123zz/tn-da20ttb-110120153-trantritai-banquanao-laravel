<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brandModels;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = brandModels::orderBy('id', 'DESC')->get();
        return view('admins.brands.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:brands|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $brand = new brandModels();
        $brand->name = $data['name'];

        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Thêm thương hiệu thành công.');
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
        $brand = brandModels::find($id);
        return view('admins.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:brands|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $brand = brandModels::find($id);
        $brand->name = $data['name'];

        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Cập nhật thương hiệu thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        brandModels::find($id)->delete();
        return redirect()->route('brand.index')->with('success', 'Xóa thương hiệu thành công.');
    }
}
