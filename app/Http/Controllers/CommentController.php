<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function createComment(Request $request){
        $this -> validate($request , [
            'comment' => 'required|min:3'
        ] , [
            'comment.required' => 'Vui lòng nhập nội dung bình luận',
            'comment.min' => 'Nội dung bình luận ít nhất 3 kí tự'
        ]);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->parent_id = $request->input('parent_id');
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return back()->with("message","Thêm bình luận thành công");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:3'
        ] , [
            'comment.required' => 'Vui lòng nhập nội dung bình luận',
            'comment.min' => 'Nội dung bình luận ít nhất 3 kí tự'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }
        else
        {
            $comment = new Comment();
            $comment->comment = $request->input('comment');
            $comment->parent_id = $request->input('parent_id');
            $comment->post_id = $request->post_id;
            $comment->user_id = Auth::user()->id;
            $comment->save();
            
            return response()->json([
                'status'=>200,
                'message'=>'Thêm bình luận thành công'
            ]);
        }
    }
}
