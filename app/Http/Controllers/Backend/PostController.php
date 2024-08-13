<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostAmount;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->with('user', 'category')->get();
        return view('backend.post.index', compact('posts'));
    }
    public function acccept($id)
    {
        $post = Post::find($id);
        $post->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Post Approved Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }
    public function Relise($id)
    {
        $post = Post::find($id);

        $amount = PostAmount::where('post_id', $id)->where('to_id', $post->user_id)->where('from_id', $post->relise_user)->first();

        if ($amount) {
            $user = User::find($post->user_id);
            $seller = User::find($post->relise_user);
            if ($post->for == 'sell') {
                if ($user) {
                    $user->wallet->update([
                        'wallet' => $user->wallet->wallet - $amount->amount
                    ]);
                }
                if ($seller) {
                    $user->wallet->update([
                        'wallet' => $user->wallet->wallet + $amount->amount
                    ]);
                }
            }
            if ($post->for == 'buy') {
                if ($user) {
                    $user->wallet->update([
                        'wallet' => $user->wallet->wallet + $amount->amount
                    ]);
                }
                if ($seller) {
                    $user->wallet->update([
                        'wallet' => $user->wallet->wallet - $amount->amount
                    ]);
                }
            }
            if ($post->exchange_amount >= $amount->amount) {
              //  dd($post);
                $post->update([
                    'exchange_amount' => $post->exchange_amount - $amount->amount,
                    'relise_user' => null,
                    'status' => 1,
                ]);
            }
            if ($post->exchange_amount <= $amount->amount) {
             //   dd($post);
                $post->update([
                    'status' => 2,
                ]);
            }
            $amount->delete();
        }

        $notification = array(
            'message' => 'Post Relise Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        $notification = array(
            'message' => 'Post Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
