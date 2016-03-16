<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Function get posts
     *
     * @return $posts
     */
    public function getAllPosts(){
        $posts = DB::table('posts')->select('posts.id', 'posts.title', 'posts.start_post', 'posts.preview', 'posts.description', 'users.name')
            ->join('users', 'posts.id_user', '=', 'users.id')
            ->orderBy('posts.start_post', 'desc')
            ->paginate(5);
        return $posts;
    }

    /**
     * Function get post by id
     *
     * @param integer $id post id
     *
     * @return $post
     */
    public function gerPostsById($id){
        $post = DB::table('posts')->select('posts.title', 'posts.start_post', 'posts.preview', 'posts.description', 'users.name')
            ->join('users', 'posts.id_user', '=', 'users.id')
            ->where('posts.id', '=', $id)
            ->get();
        return $post;
    }

    /**
     * Function create new post
     *
     * @param User $user user object
     * @param string $title name post
     * @param DateTime $date date post
     * @param string $preview preview text for post
     * @param string $description description text for post
     *
     * @return
     */
    public function createPost($user, $title, $date, $preview, $description){
        $post = new Post;
        $post->id_user=$user->id;
        $post->start_post=date_format($date, 'Y-m-d H:i:s');
        $post->title=$title;
        $post->preview=$preview;
        $post->description=$description;
        $post->save();
        return;
    }

    /**
     * Function update post
     *
     * @param integer $id id post
     * @param string $title name post
     * @param DateTime $date date post
     * @param string $preview preview text for post
     * @param string $description description text for post
     *
     * @return
     */
    public function updatePost($id, $title, $date, $preview, $description){
        $post = Post::find($id);
        $post->start_post=date_format($date, 'Y-m-d H:i:s');
        $post->title=$title;
        $post->preview=$preview;
        $post->description=$description;
        $post->save();
    }

    /**
     * Function delete post by id
     *
     * @param integer $id post id
     *
     * @return
     */
    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        return;
    }
}
