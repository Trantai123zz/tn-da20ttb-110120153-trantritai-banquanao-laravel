<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sizeModels;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $size = sizeModels::orderBy('id', 'DESC')->get();
        return view('admins.sizes.index', compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.sizes.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:sizes|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $size = new sizeModels();
        $size->name = $data['name'];

        $size->save();
        return redirect()->route('size.index')->with('success', 'Thêm size thành công.');
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
        $size = sizeModels::find($id);
        return view('admins.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:sizes|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $size = sizeModels::find($id);
        $size->name = $data['name'];

        $size->save();
        return redirect()->route('size.index')->with('success', 'Cập nhật size thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sizeModels::find($id)->delete();
        return redirect()->route('size.index')->with('success', 'Xóa size thành công.');
    }
}
