<!-- navibar -->
<div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Hiện menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="header-logo" href="/" title="doc truyen">doc bai viet</a></h1>
        </div>
        <div class="navbar-collapse collapse" itemscope="" itemtype="http://schema.org/WebSite">
            <meta itemprop="url" content="{{ url('/') }}">
            <ul class="control nav navbar-nav ">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> Danh sách <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('danhsach.truyenmoi') }}" title="Bài viết mới">Bài viết mới</a></li>
                        <li><a href="{{ route('danhsach.truyenhot') }}" title="Bài viết đáng chú ý">Bài viết đáng chú ý</a></li>
                        <li><a href="{{ route('danhsach.truyenfull') }}" title="Bài viết đã hoàn thành">Bài viết đã hoàn thành</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-list"></span> Chuyên mục<span class="caret"></span></a>
                    <div class="dropdown-menu multi-column">
                        <div class="row">

                            <?php
                            $categories = \App\Models\Category::select('id', 'name', 'alias', 'parent_id')->orderBy('id', 'DESC')->get();
                            $t = 1; $c = 1;
                            foreach($categories as $category)
                            {
                                $count = count($categories);
                                if($t == 1)
                                    echo '<div class="col-md-4"><ul class="dropdown-menu">';
                                echo '<li><a href="'. route('category.list.index', $category->alias) .'">'. $category->name .'</a></li>';
                                if($t == 10 || $count == $c){
                                    $t = 0;
                                    echo '</ul></div>';
                                }
                                $t++; $c++;
                            }
                            ?>
                        </div>
                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Tài khoản <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            @if(Auth::user())
                                <a href="{{ url("/admin/home") }}"><span class="glyphicon glyphicon-user"></span>Trang cá nhân</a>
                                <a href="{{ route('user.logout') }}" class="glyphicon glyphicon-log-out">Đăng xuất</a>
                            @else
                                <a href="{{ route('user.login') }}"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
                                <a href="{{ url("/register") }}"><span class="glyphicon glyphicon-cog"></span> Đăng ký</a>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right" action="{{ route('danhsach.search') }}" role="search" itemprop="potentialAction">
                <div class="input-group search-holder">
                    <meta itemprop="target" content="#?tukhoa={tukhoa}">
                    <input class="form-control" style="border-radius: 7px" id="search-input" type="search" name="q" placeholder="Tìm kiếm..." value="{{ old('q') }}" itemprop="query-input" required="">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit" style="border-radius: 5px"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
                <div class="list-group list-search-res hide">
                </div>
            </form>
        </div>
    </div>
    <div id="slides" class="carousel slide" data-ride="carousel">
        <div class="cac-slide">
            <ul class="carousel-indicators">
                <li data-target="#slides" data-slide-to="0" class="active"></li>
                <li data-target="#slides" data-slide-to="1"></li>
                <li data-target="#slides" data-slide-to="2"></li>
            </ul>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active"style="height:350px">
                @if(isset($slide1))
                @foreach($slide1 as $value)
                    <img src="{{asset("upload/slide"."/".$value->image)}}"  />
                    <div class="carousel-caption">
                        <button type="button" class="btn btn-outline-light btn-lg" style="background-color: #BC9458">
                            <a href="{{url('tos')}}"style="text-decoration: none">Xem chi tiết</a>
                        </button>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="navbar-breadcrumb">
        <div class="container breadcrumb-container">
            @yield('breadcrumb')
            @include('user.partials.social')
        </div>
    </div>

</div><!-- navibar -->
