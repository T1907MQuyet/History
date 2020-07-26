<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide';
    public $fillable = ['slide_title','image','status','type_slide'];

    public function getImg(){
//        $link = "upload/slide";
        return asset("upload/slide");
    }
    public function getTypeSlide()
    {
        if ($this->__get("type_slide")==1)
        {
            return "Trang Chủ";
        }else if ($this->__get("type_slide")==2)
        {
            return "Sản Phẩm";
        }
        else if ($this->__get("type_slide")==1)
        {
            return "Tin Tức";
        }else if ($this->__get("type_slide")==1)
        {
            return "Cửa Hàng";
        }else{
            return "Mặc Định";
        }

    }
}
