@extends('admin.layouts.app')
@section('head-title',"Slide {$slide->__get('slide_title')}")
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <ol class="breadcrumb breadcrumb-col-teal" style="margin: 0px">
                    <li><a href="{{route("admin.home")}}"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="{{route("slide.index")}}"><i class="material-icons">perm_media</i>   Quản Lý Slide</a></li>
                    <li class="active"><i class="material-icons">create</i> Chinh Sửa</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row clearfix">
            <div class="card">
                <div class="header">
                    <h4>
                        Slide {{$slide->__get('slide_title')}}
                    </h4>
                </div>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @foreach($errors->all() as $err)
                            <strong>{{$err}}</strong> ...
                        @endforeach
                    </div>
                @endif
                <div class="body">
                    <form method="post" action="{{url("admin/slide/update/{$slide->__get("id")}")}}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <label for="email_address">Khu vực</label>
                        <label for="">Trạng Thái</label>
                        <div class="form-group">
                            <div class="demo-radio-button">
                                <input name="status" value="1" id="radio_1" type="radio" {{($slide->__get("status")==1)? 'checked':''}}>
                                <label for="radio_1">Ẩn</label>
                                <input name="status" value="2" id="radio_2" type="radio" {{($slide->__get("status")==2)? 'checked':''}}>
                                <label for="radio_2">Hiện</label>
                            </div>
                        </div>
                        <label for="password">Tên cửa hàng</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input class="form-control" id="" value="{{$slide->__get("slide_title")}}" type="text" name="slide_title"   placeholder="Nhập tên cửa hàng">
                            </div>
                        </div>
                        <label for="">Loại Slide</label>
                        <div class="form-group">
                            <select name="type_slide" id="">
                                <option value="0" {{($slide->__get("type_slide")==0)?"selected":""}}>Mặc Định</option>
                                <option value="1" {{($slide->__get("type_slide")==1)?"selected":""}}>Trang Chủ</option>
                                <option value="2" {{($slide->__get("type_slide")==2)?"selected":""}}>Sản Phẩm</option>
                                <option value="3" {{($slide->__get("type_slide")==3)?"selected":""}}>Tin Tức</option>
                                <option value="4" {{($slide->__get("type_slide")==4)?"selected":""}}>Cửa Hàng</option>
                            </select>
                        </div>
                        <label for="">Chon ảnh</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input class="form-control" id="" type="file" name="image"   >
                            </div>
                            <img src="{{asset('upload/slide')}}/{{$slide->__get("image")}}" width="100px" alt="">
                        </div>


                        <br>
                        <button class="btn bg-cyan waves-effect" type="submit">CẬP NHẬT SLIDE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
