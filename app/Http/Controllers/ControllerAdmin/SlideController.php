<?php

namespace App\Http\Controllers\ControllerAdmin;
use Illuminate\Http\Request;;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use File;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    public function index()
    {

        $slide = Slide::paginate(10);
        $slide_an = Slide::where("status",1)->get();
        $slide_hien = Slide::where("status",2)->get();
        return view("admin.slide.index",compact('slide','slide_an','slide_hien'));
    }

    public function new()
    {
        return view("admin.slide.new ");
    }
    public function save(Request $request)
    {
//        dd($request->all());
        $random = Str::random(4);
        $request->validate([
            "slide_title"=>"required|min:3|unique:slide",
        ],[
            "slide_title.required"=>"Tiêu đề không được để trống....",
            "slide_title.min"=>"Tiêu đề phải từ 3 ký tự....",
            "slide_title.unique"=>"Tiêu đề không được trùng lặp...",
        ]);
        $image = "";
        if ($request->hasFile('image')){
            $file = $request->image;
            $image = $file->getClientOriginalName();
            $anh = $random."_".$image;
            while (file_exists("upload/slide".$anh)){
                $anh = $random."_".$image;
            }
            $file->move(base_path("public/upload/slide"),$anh);

        }
        try {
            Slide::create([
                'status'=>$request->get('status'),
                'slide_title'=>$request->get('slide_title'),
                'image'=>$anh,
                'type_slide'=>$request->get('type_slide')
            ]);

        }catch (\Exception $exception)
        {
            return redirect()->back();
        }
        return redirect()->to('admin/slide')->with('thong_bao','Thêm slide thành công....');
    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view("admin.slide.edit",compact('slide'));
    }

    public function update($id,Request $request)
    {
        $random = Str::random(4);
        $slide = Slide::findOrFail($id);

        $request->validate([
            "slide_title"=>"required|min:3",
        ],[
            "slide_title.required"=>"Tiêu đề không được để trống....",
            "slide_title.min"=>"Tiêu đề phải từ 3 ký tự....",

        ]);
        if ($request->hasFile('image')){
            $file = $request->image;
            $image = $file->getClientOriginalName();
            if (!is_null("upload/slide/".$slide->__get("image"))){
                unlink("upload/slide/".$slide->__get("image"));
            }
            $anh = $random."_".$image;
            while (file_exists("upload/slide".$anh)){
                $anh = $random."_".$image;
            }
            $file->move(base_path("public/upload/slide"),$anh);
        }else{
            $anh = $slide->__get('image');
        }

        try {
            $slide->status = $request->get("status");
            $slide->slide_title = $request->get("slide_title");
            $slide->image = $anh;
            $slide->type_slide = $request->get("type_slide");

            $slide->save();

        }catch (\Exception $exception)
        {
            return redirect()->back();
        }
        return redirect()->to('admin/slide')->with("thong_bao","Cập nhật thành công....");

    }

    public function delete($id)
    {
        $slide =  Slide::findOrFail($id);


        try {
            $slide->delete();
            if (is_null("upload/slide/".$slide->__get("image"))){
            }else{
                unlink("upload/slide/".$slide->__get("image"));
            }
        }catch (\Exception $exception)
        {
            return redirect()->back();
        }
        return redirect()->to('admin/slide')->with("thong_bao","Xóa Slide thành công.....");
    }


    //check
    public function check($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slide.check',compact('slide'));
    }
    public function checkAn(Request $request)
    {
        $status = $request->__get("index_status");
//        dd($status);
        $slide = Slide::where("status",$status)->paginate(10);
        $slide_an = Slide::where("status",1)->get();
        $slide_hien = Slide::where("status",2)->get();
        return view("admin.slide.index",compact('slide','slide_an','slide_hien'));
    }
    public function checkHien(Request $request)
    {
        $status = $request->__get("index_status");
//        dd($status);
        $slide = Slide::where("status",$status)->paginate(10);
        $slide_an = Slide::where("status",1)->get();
        $slide_hien = Slide::where("status",2)->get();
        return view("admin.slide.index",compact('slide','slide_an','slide_hien'));
    }
}
