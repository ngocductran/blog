<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\EditRequest;

class PostController extends Controller
{
    public function listPost(){
        $post = Post::all();
        return view('admin.layout.posts.list', ['post' => $post]);
    }

    public function getCreatePost(){
        $cate = Category::where('status', '1')->get();
        return view('admin.layout.posts.create', ['cate' => $cate]);
    }

    public function postCreatePost(CreateRequest $request){

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.rand().'.'.$fileType;
                $file -> move('admin/images/posts',$AvatarName);
                $urlAvatar = 'admin/images/posts/'.$AvatarName;

                $post = new Post;
    	        $post->title = $request->input('title');
                $post->slug = $request->input('slug');
                $post->description = $request->input('description');
                $post->category_id = $request->input('category');
                $post->content = $request->input('content');
                $post->tags = $request->input('tags');
                $post->avatar = $urlAvatar;
                $post->user_id = Auth::user()->id;
                $post->author = Auth::user()->id;
                $post->status = $request->input('status');

                $post -> save();

                return redirect()->route('admin.list.post')->with('success', 'Thêm bài viết thành công.');;

            }
            else{
                return back()->with("error","Phải là file ảnh (jpg , png ,jpeg)");
            }
        }
        else{
            return back()->with("error","Bạn chưa chọn ảnh");
        }
    }

    public function getDeletePost($id){
        $post = Post::find($id);

        if($post){

            $description = $post->avatar;

            if(File::exists($description)){
                File::delete($description);
            }

            $post->delete();
            return redirect()->route('admin.list.post')->with('warning', 'Xóa bài viết thành công.');
        }
        else{
            return redirect()->route('admin.list.post')->with('warning', 'Không tìm thấy bài viết cần xóa.');
        }

    }

    public function getEditPost($id){
        $post = Post::find($id);
        $category = Category::where('status', '1')->get();
        return view('admin.layout.posts.edit', ['post' => $post], ['cate' => $category]);
    }

    public function postEditPost(EditRequest $request, $id){
        $post = Post::find($id);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');

            //xóa ảnh
            $desc = $post->avatar;
            if(File::exists($desc)){
                File::delete($desc);
            }

            $AvatarName = 'avatar_'.rand().'.'.$fileType;
            $file -> move('admin/images/posts',$AvatarName);
            $urlAvatar = 'admin/images/posts/'.$AvatarName;

            $post->avatar = $urlAvatar;
        }

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->description = $request->input('description');
        $post->category_id = $request->input('category');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->user_id = Auth::user()->id;
        $post->status = $request->input('status');
        $post->update();

        return redirect()->route('admin.list.post')->with('success', 'Chỉnh sửa bài viết thành công.');
    }
}
