<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->select('id', 'title', 'price', 'description', 'stock', 'image')
            ->paginate(3);
        return view('products.index', compact('products'));
    }

    // thêm sản phẩm
    public function create()
    {
        return view('products.add');
    }


    public function store(Request $request)
    {
        $dataValidator = $request->validate(
            [
                'title' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'nullable',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'status' => 'required|numeric|min:0',
            ]
        );
        $random = Str::random(5);
        $dataValidator['slug'] = Str::of($request->title . '-' . $random)->slug;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $dataValidator['image'] = $imageName;
        $product = Product::create($dataValidator);
        Session::flash('message', 'Thêm thành công');
        return redirect()->route('products.index');

    }

    // sửa sản phẩm
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('message', 'Cập nhật sản phẩm thành công!');
    }

    // xoá sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh nếu có
        if ($product->image) {
            $imagePath = public_path('storage/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Xóa sản phẩm thành công!');
    }

}
