<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index(){
        $sliders=Slider::all();
        return view('admin.slider.index',compact('sliders')) ;
    }

    public function create(){
        return view('admin.slider.create') ;
    }

    public function store(SliderFormRequest $request){
        $validatedData=$request->validated();

        if($request->hasFile('image')){
            $file=$request->file('image');

            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('upload/slider/',$filename);
            $validatedData['image']="upload/slider/$filename";

        }
        $validatedData['status']= $request->status==true?'1':'0';
        Slider::create([
            'title' =>$validatedData['title'],
            'description'=>$validatedData['description'],
            'image'=>$validatedData['image'],
            'status'=>$validatedData['status'],
        ]);
        return redirect('admin/slider')->with('message','Slider added Successfully');
    }

    public function edit(int $slider_id){
        $slider=Slider::findOrFail($slider_id);
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider){
        //for check  return $slider;
        $validatedData=$request->validated();

        if($request->hasFile('image')){
         $destination=$slider->image;
          if(File::exists($destination))
            {
                File::delete($destination);
            }
        $file=$request->file('image');

        $ext=$file->getClientOriginalExtension();
        $filename=time().'.'.$ext;
         $file->move('upload/slider/',$filename);
         $validatedData['image']="upload/slider/$filename";
        }
        $validatedData['status']= $request->status==true?'1':'0';
        Slider::where('id',$slider->id)->update([
            'title' =>$validatedData['title'],
            'description'=>$validatedData['description'],
            'image' =>$validatedData['image']??$slider->image, //$slider->image because mahile nullable banayako thiyanam database ma so..,
            'status'=>$validatedData['status'],
        ]);
        return redirect('admin/slider')->with('message','Slider Updated Successfully');
    }

    public function destroy(Slider $slider){
        if($slider->count()>0){
            $destination=$slider->image;
            if(File::exists($destination))
              {
                  File::delete($destination);
              }
            $slider->delete();
            return redirect('admin/slider')->with('message','Slider Deleted Successfully');
        }
        return redirect('admin/slider')->with('message','Something went wrong');

    }

}

