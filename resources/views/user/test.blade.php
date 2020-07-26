<div>
    <span>
        <a target="_blank" class=" UFICommentActorName" dir="ltr" href="https://www.facebook.com/vanquyet.nguyen.1048554">Nguyễn Văn Quyết</a></span><div class="_3-8m"><div class="_30o4"><span><span class="_5mdd"><span>haha</span></span></span><span></span></div></div><div class="_2vq9 fsm fwn fcg"><a href="#">Thích</a><span aria-hidden="true"> · </span><a href="#">Phản hồi</a><span aria-hidden="true">
            · </span><span><a class="uiLinkSubtle" href="http://globalhistory.abc/tos?fb_comment_id=4731203496905049_4731231713568894" data-ft="{&quot;tn&quot;:&quot;N&quot;}" target="_blank"><abbr aria-label="vài giây trước" minimize="true" class="UFISutroCommentTimestamp livetimestamp" data-utime="1595545477" data-minimize="true" data-shorten="true">1 phút</abbr></a></span></div>
     <div class="_44ri _2pis"><div class="_3-8y clearfix" direction="left"><div class="_ohe lfloat"><a href="https://www.facebook.com/vanquyet.nguyen.1048554" src="https://scontent.fhan5-4.fna.fbcdn.net/v/t1.0-1/cp0/p48x48/91358490_248712566523737_7404945912373444608_n.jpg?_nc_cat=104&amp;_nc_sid=dbb9e7&amp;_nc_ohc=VtZ7iMCr95gAX8DQDVL&amp;_nc_ht=scontent.fhan5-4.fna&amp;oh=15ed703baa5a4a914acf0e2438363c22&amp;oe=5F40C1E1" target="_blank" class="img _8o _8s UFIImageBlockImage"><img class=" _1cj img" src="https://scontent.fhan5-4.fna.fbcdn.net/v/t1.0-1/cp0/p48x48/91358490_248712566523737_7404945912373444608_n.jpg?_nc_cat=104&amp;_nc_sid=dbb9e7&amp;_nc_ohc=VtZ7iMCr95gAX8DQDVL&amp;_nc_ht=scontent.fhan5-4.fna&amp;oh=15ed703baa5a4a914acf0e2438363c22&amp;oe=5F40C1E1" alt=""></a></div>
            <div class=""><div class="UFIImageBlockContent _42ef clearfix" direction="right">
                    <div class="_ohf rfloat"><div></div></div><div class="">






                        <div class="visible-md visible-lg"style="background: #f4f4f4;border-radius: 5px">
                            <div class="col-md-12 comment list"style="background:#f4f4f4">
                                <div class="col-md-9 comment" >
                                    @foreach($comments as  $comment)
                                        <ul>
                                            <li class="com-tittle" style="background: #f2f3f5;margin-top:auto;list-style: none;color: black" >
                                                {{isset($comment->user) ? $comment->user->name : 'Default'}}
                                            </li>
                                            <li class="com-tittle" style="background: #f2f3f5;margin-top:auto;list-style: none;font-size:10px;font-family: " >
                                                <i>{{date('d/m/Y H:i',strtotime($comment->created_at))}}</i>
                                                <br>
                                            </li>
                                            <li class="com-tittle" style="background: #f2f3f5; border-radius: 10px;margin-top:auto;list-style: none;font-size: 14px" >
                                                {{$comment->NoiDung}}
                                                <br>
                                            </li>
                                        </ul>
                                        <hr  width="30%" size="5px" align="center" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
