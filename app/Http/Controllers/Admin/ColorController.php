<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index(){
        //for $colors use $colors and compact
        $colors=Color::all();
        return view('admin.color.index',compact('colors'));
    }
    public function create(){
        return view('admin.color.create');
    }
    public function store(ColorFormRequest $request){
        $validatedData=$request->validated();
        $color=new Color;
        $color->name=$validatedData['name'];
        $color->code=$validatedData['code'];
        $color->status=$request->status==true?'1':'0';
        $color->save();
        return redirect('admin/color')->with('message','color Added');
    }
    public function edit(int $color_id){
        $color=Color::findOrFail($color_id);
        return view('admin.color.edit',compact('color'));

    }
    public function update(ColorFormRequest $request, $color){
        $validatedData=$request->validated();
        // Color::findOrFail($color)->update($validatedData);

       // or
        $color=Color::findOrFail($color);
        $color->name=$validatedData['name'];
        $color->code=$validatedData['code'];
        $color->status=$request->status==true?'1':'0';
        $color->update();
        return redirect('admin/color')->with('message','Color is successfully Updated');

    }
    public function destroy($id){
        $color=Color::findOrFail($id);
        if($color){
            $color->delete();
        }
        return redirect('admin/color')->with('message','Color is successfully deleted');

    }


}
