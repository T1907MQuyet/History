@extends('admin.layouts.app')
@section('head-title','Slide')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h4>
                        TRẠNG THÁI
                    </h4>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <ul class="dropdown-menu pull-right">
                                <li><a class=" waves-effect waves-block" href="{{route('slide.index')}}">Tất cả</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                            <form action="{{route("check-status-an")}}">
                                <input type="hidden" name="index_status" value="1">
                                <button class="btn bg-red btn-lg btn-block waves-effect" type="submit">Ẩn <span class="badge">{{count($slide_an)}}</span></button>
                            </form>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                            <form action="{{route("check-status-hien")}}">
                                <input type="hidden" name="index_status" value="2">
                                <button class="btn bg-teal btn-lg btn-block waves-effect" type="submit">Hiện <span class="badge">{{count($slide_hien)}}</span></button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h4>
                        DANH SÁCH CÁC SILDE
                    </h4>
                    {{--<ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <ul class="dropdown-menu pull-right">
                                <li><a class=" waves-effect waves-block" href="{{route("new-slide")}}">Thêm mới slide</a></li>

                            </ul>
                        </li>
                    </ul>--}}

                </div>

                @if(session('thong_bao'))
                    <div class="header">
                        <div class="alert alert-success">
                            {{session('thong_bao')}}
                        </div>
                    </div>
                @endif

                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead class="text-center">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Ảnh</th>
                            <th>Trạng Thái</th>
                            <th>Ngày tạo</th>
                            <th>Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($slide->isNotEmpty())
                            @foreach($slide as $key => $value)
                            <tr >
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{$value->__get('slide_title')}}<br>
                                    ({{$value->getTypeSlide()}})
                                </td>
                                <td>
                                    <img  src="{{asset('upload/slide')}}/{{$value->__get('image')}}" width="80px" alt="">
                                </td>
                                @if($value->__get('status')==1)
                                    <td><p class="btn bg-red btn-block btn-xs waves-effect" style="width: 60%">Ẩn</p></td>
                                @elseif($value->__get('status')==2)
                                    <td><p class="btn bg-teal btn-block btn-xs waves-effect" style="width: 60%">Hiện</p></td>

                                @endif
                                <td>{{$value->__get('created_at')}}</td>
                                <td>
                                    <a href="{{ route('delete-slide', $value->__get("id") )}}" class="label bg-blue">Xóa</a>
                                    <a href="{{ route('edit-slide', $value->__get("id") )}}" class="label bg-red">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
