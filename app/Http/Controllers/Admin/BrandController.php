<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;

class BrandController extends Controller
{
    public function index(){
        $brands=Brand::all();
        $categories=Category::where('status','0')->get();
        return view('admin.brands.index',compact('brands','categories'));
    }

    public function create(){
        $categories=Category::all();
        return view('admin.brands.create',compact('categories'));
    }

    public function store(BrandFormRequest $request){
        // dd($request); for check
        $validatedData=$request->validated();
        $category=Category::findOrFail($validatedData['category_id']);
        $brand=new Brand;
        $brand->category_id=$validatedData['category_id'];
        $brand->name=$validatedData['name'];
        $brand->slug=Str::slug($validatedData['slug']);
        $brand->status=$request->status==true ?'1':'0';
        $brand->save();
        return redirect('admin/brands')->with('message','the Brand added');

    }

    public function edit($brand_id){
        $brand=Brand::findOrFail($brand_id);
        $categories=Category::all();
        return view('admin.brands.edit',compact('brand','categories'));
    }

    public function update(BrandFormRequest $request ,$brand_id){
        $validatedData=$request->validated();
        $brand=Brand::findOrFail($brand_id);


        $brand->category_id=$validatedData['category_id'];
        $brand->name=$validatedData['name'];
        $brand->slug=Str::slug($validatedData['slug']);
        $brand->status=$request->status ==true ?'1':'0';
        $brand->update();
        return redirect('admin/brands')->with('message','the brand is updated');

    }

    public function delete($id){
        $brand=Brand::Find($id);
        if(!is_null($brand)){
            $brand->delete();
            return redirect('admin/brands')->with('message','brand is deleted');
        }
        return redirect('admin/brands');

    }

}
