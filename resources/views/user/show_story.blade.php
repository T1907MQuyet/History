@extends('user.layouts.app')
@section('title', $story->name)
@section('seo')
    <meta name="robots" content="noindex">
@endsection
@section('breadcrumb')
    {!! showBreadcrumb($breadcrumb) !!}
@endsection
@section('content')
    <div class="container" id="truyen"">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="col-xs-12 col-info-desc">
                <div class="title-list"><h2>Thông tin bài viết</h2></div>
                <div class="col-xs-12 col-sm-4 col-md-4 info-holder">
                    <div class="books">
                        <div class="book">
                            <img src="{{ url($story->image) }}" alt="{{ $story->name }}" itemprop="image">
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <h3>Tác giả:</h3>
                            {!!  $story->user->name !!}
                        </div>
                        <div>
                            <h3>Người viết  :</h3>
                            {!!  $story->user->name !!}
                        </div>
                        <div>
                            <h3>Thể loại:</h3>
                            {!!  the_category($story->categories) !!}
                        </div>
                        <div>
                            <h3>Lượt xem:</h3>
                            {!!  number_format($story->view) !!}
                        </div>
                        <div>
                            <h3>Trạng thái:</h3> {!! statusStoryShow($story->status) !!}
                        </div>
                        @if($story->source)
                        <div>
                            <h3>Nguồn bài viết:</h3> {!! $story->source !!}
                        </div>
                        @endif
                        <div>
                   <div class="navbar-social pull-left">
  <div class="g-plusone" data-href="{{ route('story.show', $story->alias) }}" data-annotation="bubble" data-height="20" data-rel="publisher"></div>
                            <div class="navbar-social pull-left">
                     <div class="fb-like" data-href="{{ route('story.show', $story->alias) }}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 desc">
                    <h3 class="title" itemprop="name">{{ $story->name }}</h3>
                    <div class="desc-text desc-text-full" itemprop="about">
                        {!!  nl2p($story->content, false) !!}
                    </div>
                    <div class="showmore">
            					<a class="btn btn-default btn-xs" href="javascript:void(0)" title="Xem thêm">Xem thêm »</a>
            				</div>

                    <?php
                    $chapters = $story->chapters()->where('active', 1)->orderBy("created_at", "desc")->take(5)->get();
                    if ($chapters) {
                      echo '<div class="l-chapter"><div class="l-title"><h3>Các chương mới nhất</h3></div><ul class="l-chapters">';
                      foreach($chapters as $chapter):
                      ?>
                      <li>
                        <span class="glyphicon glyphicon-certificate"></span>
                        <a href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                            <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                        </a>
                      <?php
                          endforeach;

                          echo '</ul></div>';
                    }
                    ?>
                </div>
            </div>

            <div class="ads container">
                {!! \App\Models\Option::getvalue('ads_story') !!}
            </div>

            <div class="col-xs-12" id="list-chapter"style="border-radius: 5px">
                <div class="title-list"><h2>Danh sách chương</h2></div>
                <div class="row">
                    <?php
                    $t = 1; $c = 1;
                    $chapters = $story->chapters()->where('active', 1)->paginate(50);
                    foreach($chapters as $chapter):
                        $count = count($chapters);
                        if($t == 1) echo ' <div class="col-xs-12 col-sm-6 col-md-6"><ul class="list-chapter">';
                    ?>
                            <li>
                                <span class="glyphicon glyphicon-certificate"></span>
                                <a href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                                    <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                                </a>
                            </li>
                    <?php
                        if($t == 25 || $count == $c){
                            $t = 0;
                            echo '</ul></div>';
                        }
                            $t++; $c++;
                        endforeach;
                        ?>
                </div>

                {{ $chapters->fragment('list-chapter')->links() }}

            </div>
            <div class="visible-md visible-lg"style="border-radius: 5px">
                <div class="col-xs-12 comment-box"style="border-radius: 5px">
                    <div class="title-list">
                        <h2>Viết bình luận</h2>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="formcomment">
                                                        @if(Auth::user())
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                        <form action="comment/{{$story->id}}" method="post" role="form">
                                                            <div class="form-group">
                                                                <textarea class="form-control"  name="NoiDung"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                                            </div>
                                                            {{csrf_field()}}
                                                        </form>
                                                        @else
                                                            <a href="{{ route('user.login') }}"><span class="#" style="margin-left:45%;color:red"></span> Bạn chưa đăng nhập!</a>
                                                        @endif
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <hr  width="100%" size="15px" align="center" />
                        <div class="visible-md visible-lg"style="background: #f4f4f4;border-radius: 5px">
                            <div class="col-md-12 comment list"style="background:#f4f4f4">
                                <div class="col-md-9 comment" >
                                    @foreach($comments as  $comment)
                                        <ul>
                                            <li class="com-tittle" style="background: #f2f3f5;margin-top:auto;list-style: none;color:#2a6496;text-transform:none" >
                                                {{isset($comment->user) ? $comment->user->name : 'Default'}}
                                            </li>
                                            <li class="com-tittle" style="background: #f2f3f5; border-radius: 10px;margin-top:auto;list-style: none;font-size:7px;color: black;font: caption;text-transform:none" >
                                               {{$comment->NoiDung}}
                                                <br>
                                            </li>
                                            <li class="com-tittle" style="background: #f2f3f5;margin-top:auto;list-style: none;font-size:10px;" >
                                                <i>{{date('d/m/Y H:i',strtotime($comment->created_at))}}</i>
                                                <br>
                                            </li>
                                        </ul>
                                    @endforeach
                                    <div class="pagination" style="margin-left: 50%">{{$comments->links()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                   {{-- <div class="fb-comments fb_iframe_widget"  data-width="832" data-numposts="5" data-colorscheme="light">
                    </div>--}}
                </div>
        </div>
        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @include('user.widgets.storiesByAuthor')
            @include('user.widgets.hotstory')
        </div>
    </div>

@endsection
