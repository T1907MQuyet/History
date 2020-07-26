@extends('user.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Đăng nhập</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('post.user.login') }}">
                        @if (Session::has('danger') && ($message = Session::get('danger')))
                            <div class="alert alert-danger alert-dismissible">
                                <p><i class="icon fa fa-ban"></i>{!! $message !!}</p>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->first('email') }}">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->first('password') }}">
                            <label class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-6 col-md-offset-4">--}}
{{--                                <div class="checkbox">--}}
{{--                                    <label>--}}
{{--                                        <input type="checkbox" name="remember" checked> Lưu đăng nhập ?--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-btn fa-sign-in"></i> Đăng nhập</button>
                                <a class="btn btn-link" href="{{ url("/register") }} ">Đăng ký</a>
								<br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
