<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\colorModels;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color = colorModels::orderBy('id', 'DESC')->get();
        return view('admins.colors.index', compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:colors|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $color = new colorModels();
        $color->name = $data['name'];

        $color->save();
        return redirect()->route('color.index')->with('success', 'Thêm màu sắc thành công.');
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
        $color = colorModels::find($id);
        return view('admins.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:colors|max:255',


            ],
            [

                'name.required' => 'Tên thương hiệu phải có nhé',


            ]
        );
        $color =  colorModels::find($id);
        $color->name = $data['name'];

        $color->save();
        return redirect()->route('color.index')->with('success', 'Cập nhật màu sắc thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        colorModels::find($id)->delete();
        return redirect()->route('color.index')->with('success', 'Xóa màu sắc thành công.');
    }
}
