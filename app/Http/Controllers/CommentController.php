<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public  function postComment(Request $request,$id){
        $idTinTuc = $id;
        $tintuc = Story::find($id);
        $comment = new  Comment;
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser  = Auth::user()->id;

        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return  redirect()->back();



    }
}
