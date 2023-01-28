<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;


class ProductController extends Controller
{
    public function index(){
        $products=Product::all();
        return view('admin.product.index',compact('products'));
    }

    public function create(){
        $categories=Category::all();
        $brands=Brand::all();
        $colors=Color::all();
        return view('admin.product.create',compact('categories','brands','colors'));
    }

    public function store(ProductFormRequest $request){
        $validatedData=$request->validated();

        $category=Category::findOrFail($validatedData['category_id']);

        $product=$category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'slug'=>$validatedData['slug'],
            'brand'=>$validatedData['brand'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending==true?'1':'0',
            'status'=>$request->status==true?'1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
            'meta_description'=>$validatedData['meta_description'],
        ]);
        //return $product->id; for error check and get product id

        //for image
        if($request->hasFile('image')){
            $path='upload/product/';
            $i=1;
            foreach($request->file('image') as $imageFile){
                $ext=$imageFile->getClientOriginalExtension();
                $fileName=time().$i++.'.'.$ext;
                $imageFile->move($path,$fileName);
                $finalImagePathName=$path.$fileName;


                $product->ProductImage()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName,
                ]);
            }
            if($request->colors){
                foreach($request->colors as $key=>$color){
                    $product->ProductColors()->create([
                        'product_id'=>$product->id,
                        'color_id'=>$color,
                        'quantity'=>$request->colorquantity[$key]?? 0 ,
                    ]);
                }
            }
        }
        return redirect('admin/product')->with('message','Product Added Successfully');



    }
    public function edit(int $product_id){

        $categories=Category::all();
        $brands=Brand::all();
        $product=Product::findOrFail($product_id);
        return view('admin.product.edit',compact('categories','brands','product'));
    }
    public function update(ProductFormRequest $request,int $product_id){
        $validatedData=$request->validated();

        $product=Category::findOrFail($validatedData['category_id'])
                            ->products()->where('id',$product_id)->first();

        if($product){

            $product->update([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'slug'=>$validatedData['slug'],
            'brand'=>$validatedData['brand'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending==true?'1':'0',
            'status'=>$request->status==true?'1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
            'meta_description'=>$validatedData['meta_description'],
            ]);

            // for image
            if($request->hasFile('image')){
                $path='upload/product/';
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $ext=$imageFile->getClientOriginalExtension();
                    $fileName=time().$i++.'.'.$ext;
                    $imageFile->move($path,$fileName);
                    $finalImagePathName=$path.$fileName;


                    $product->ProductImage()->create([
                        'product_id'=>$product->id,
                        'image'=>$finalImagePathName,
                    ]);
                }
            }
          return redirect('admin/product')->with('message','Product Updated Successfully');

        }
        else{
            return redirect('admin/product')->with('message','No such Product id Found');
        }
    }

    public function destroyImage($product_image_id){
        $productImage=ProductImage::findOrFail($product_image_id);

        if(File::exists($productImage)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
    }
    public function destroy(int $product_id){
        $product= Product::findOrFail($product_id);
        if($product->ProductImage){
            foreach($product->ProductImage as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Product Deleted with all images');
    }
}
