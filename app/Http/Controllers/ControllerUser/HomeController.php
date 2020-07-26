<?php

namespace App\Http\Controllers\ControllerUser;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * load giao diện trang home
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slide1 = Slide::orderBy("id","ASC")->where("status",2)->get();
        return view('user.home.index',compact('slide1'));
    }

    public function tos()
    {
        $slide1 = Slide::orderBy("id","ASC")->where("status",2)->get();
        return view('user.tos',compact('slide1'));
    }

    /**
     * load giao diện trang liên hệ
     */
    public function contact()
    {
        return view('user.contact');
    }

    /**
     * Load sitemap tối ưu seo của trang
     * @return mixed
     */
    public function sitemap()
    {
        $categories = \App\Models\Category::select('alias', 'updated_at')->get();
        $authors     = \App\Models\Author::select('alias', 'updated_at')->get();
        $stories    = \App\Models\Story::select('alias', 'updated_at')->orderBy('created_at', 'DESC')->get();
        $contents = \View::make('user.sitemap')->with(['categories' => $categories , 'authors' =>$authors, 'stories' =>$stories]);
        $response = \Response::make($contents, 200);
        $response->header('Content-Type', 'application/xml');
        return $response;
    }

    // Gửi thông tin đến Admin
    public function sendContact(Request $request)
    {
        $data = $request->all();
        \Mail::send('email.contact', $data, function($m) use ($data){
            $m->from($data['email'], $data['name']);
            $m->to(\App\Models\Option::getvalue('email_contact'), 'Admin');
            $m->subject($data['subject'] . ' - Từ trang web bài viết');
        });
        return 'Email Đã Được Gửi, Cảm ơn bạn !';
    }
}
