<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    //post home page
    public function create()
    {
        $posts = Post::when(request('searchKey'), function ($query) {

            $key = request('searchKey');
            $query->orWhere('title', 'like', "%" . $key . "%")
                ->orWhere('description', 'like', "%" . $key . "%");
        })
            ->orderBy('created_at', 'desc')->paginate(4);
        return view('create', compact('posts'));

    }

    //post create
    public function createPost(Request $request)
    {
        $this->validationCheck($request);
        $data = $this->getPostData($request);


        if ($request->hasFile('postImage')) {
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }


        Post::create($data);
        return redirect()->route("create#postPage")->with(['insertSuccess' => 'Post ဖန်တီးခြင်း အောင်မြင်ပါသည်']);
    }

    //delete post
    public function deletePost($id)
    {
        Post::where('id', $id)->delete();
        //  Post::find($id)->delete();
        return redirect()->route("create#postPage")->with(['deleteSuccess' => 'Post ဖျက်သိမ်းခြင်း အောင်မြင်ပါသည်']);
    }

    //update post page
    public function updatePostPage($id)
    {
        $post = Post::where('id', $id)->first();
        // dd($post->toArray());
        return view('update', compact('post'));
    }

    // update post
    public function updatePost(Request $request)
    {
        $this->validationCheck($request);
        $data = $this->getPostData($request);
        $id = $request->postId;


        $oldImageName = Post::select('image')->where('id', $request->postId)->first();
        $oldImageName = $oldImageName['image'];

        if ($request->hasFile('postImage')) {

            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }

            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        } else {

            $data['image'] = $oldImageName;
        }

        Post::where('id', $id)->update($data);
        return redirect()->route("post#home")->with(['createSuccess' => 'Post ပြောင်းလဲခြင်း အောင်မြင်ပါသည်']);
    }


    //edit post
    public function editPost($id)
    {
        $post = Post::where("id", $id)->first();
        return view('edit', compact('post'));
    }
    //private post create data
    private function getPostData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $request->postImage,
            'price' => $request->postPrice,
            'rating' => $request->postRating,
            'address' => $request->postAddress,
        ];
    }
    //private function image
    // private function getMyImage($request){
    //    return [
    //     if ($request->hasFile('postImage')) {
    //         $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
    //         $request->file('postImage')->storeAs('public', $fileName);
    //         $data['image'] = $fileName;
    //     }
    //    ];
    // }
    //private function validation
    private function validationCheck($request)
    {
        $validationRules = [
            'postTitle' => 'required|min:5|unique:posts,title,' . $request->postId,
            'postDescription' => 'required',
            'postImage' => 'mimes:jpg,png,jpeg,webp',
            'postPrice' => 'required',
            'postAddress' => 'required',
            'postRating' => 'required|lte:5',

        ];
        $validationMessages = [
            'postTitle.required' => 'Post title ဖြည့်ရန်လိုအပ်ပါသည်',
            'postTitle.min' => "Post title ၅ လုံးထက်ပိုရန် လိုအပ်ပါသည်",
            'postTitle.unique' => 'Post title နာမည်တူနေပါသည်',
            'postDescription.required' => 'Post title ဖြည့်ရန်လိုအပ်ပါသည်',
            'postImage.required' => 'Post Image ဖြည့်ရန်လိုအပ်ပါသည်',
            'postImage.mimes' => 'Post Image သည် jpg,png,jpeg,webp ဖြစ်ရန်လိုအပ်ပါသည်',
            'postPrice.required' => 'Post price ဖြည့်ရန်လိုအပ်ပါသည်',
            'postAddress.required' => 'Post address ဖြည့်ရန်လိုအပ်ပါသည်',
            'postRating.required' => 'Post rating  ဖြည့်ရန်လိုအပ်ပါသည်',
            'postRating.lte' => 'Post rating သည် ၅ သို.မဟုတ် ၅ ထက်ငယ်ရပါမည်',
        ];
        Validator::make($request->all(), $validationRules, $validationMessages)->validate();
    }
}
