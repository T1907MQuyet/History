@extends('user.layouts.app')
@section('title', 'Event Of History')
@section('breadcrumb')
    {!! showBreadcrumb([[url('tos'), 'Sự kiện']]) !!}
@endsection
@section('content')
    <div class="container single-page" id="tos">
        <div class="row">
            <div class="list list-truyen col-xs-12">
                <div class="title-list"><h2>SỰ kiện Globab History</h2></div>
                <div class="row">
                    <div class="col-xs-12 content" style="font: caption">
                        {!! \App\Models\Option::getvalue('tos_content') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container single-page">
        <div class="fb-comments" data-href="http://globalhistory.abc/tos" data-numposts="5" data-width="1100" ></div>
    </div>
@endsection
