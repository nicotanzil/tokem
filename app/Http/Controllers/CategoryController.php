<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('category.add-category')->with('categories', $categories);
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required|unique:categories,name|alpha'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = new Category();

        $category->name = $request->name;

        $category->save();

        return redirect()->route('categories')->with('success', 'Category has been added');        
    }
    
}
