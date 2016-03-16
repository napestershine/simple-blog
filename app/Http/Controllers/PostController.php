<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


class PostController extends Controller{

    /**
     * Controller public function for view posts
     *
     * @return view public posts postsPublic.blade.php
     */
    public function index(){
        $post = new Post();
        $listPosts = $post->getAllPosts();
        return view("postsPublic", ['listPosts' => $listPosts]);
    }

    /**
     * Controller public function for view posts in personal page
     *
     * @return view personalPosts.blade.php
     */
    public function getListPosts(){
        $post = new Post();
        $listPosts = $post->getAllPosts();
        return view("personalPosts", ['listPosts' => $listPosts]);
    }

    /**
     * Controller public function viev post by id
     *
     * @param integer $id post id
     *
     * @return view postsSingle.blade.php
     */
    public function getPost($id){
        $post = new Post();
        $singlePost = $post->gerPostsById($id);
        return view("postsSingle", ['singlePost' => $singlePost]);
    }

    /**
     * Controller public function create post
     *
     * @return view postCreate.blade.php
     */
    public function postCreate(){
        if(!Auth::check()) {
            return Redirect::intended('posts');
        }else{
            if(Input::has('title')) {
                $title = Input::get('title');
                $startDate = Input::get('startDate');
                $preview = Input::get('preview');
                $description = Input::get('description');

                $validators = Validator::make(
                    array(
                        'title' => $title,
                        'startDate' => $startDate,
                        'preview' => $preview,
                    ),
                    array(
                        'title' => 'required|min:2|max:255',
                        'startDate' => 'required',
                        'preview' => 'required|min:2',
                    )
                );
                $errors = "";
                if ($validators->fails()){
                    $errorMessage = $validators->messages();
                    foreach($errorMessage->all() as $messages){
                        $errors .= $messages. "<br>";
                    }
                }else{
                    $date = date_create($startDate);
                    $post = new Post();
                    $errors .= $post->createPost( Auth::user(),$title, $date, $preview, $description );
                    if ($errors == "") {
                        return Redirect::to('personal');
                    }
                }
                return View::make('postCreate', array('errors' => isset($errors) ? $errors : null));
            }else{
                return View::make('postCreate', array('errors' => isset($errors) ? $errors : null));
            }
        }
    }

    /**
     * Controller public function for update post by id
     *
     * @param integer $id post id
     *
     * @return view postEdit.blade.php
     */
    public function postEdit($id){
        if(!Auth::check()) {
            return Redirect::intended('posts');
        }else{
            $post=Post::find($id);
            if(Input::has('title')) {
                $title = Input::get('title');
                $startDate = Input::get('startDate');
                $preview = Input::get('preview');
                $description = Input::get('description');

                $validators = Validator::make(
                    array(
                        'title' => $title,
                        'startDate' => $startDate,
                        'preview' => $preview,
                    ),
                    array(
                        'title' => 'required|min:2|max:255',
                        'startDate' => 'required',
                        'preview' => 'required|min:2',
                    )
                );
                $errors = "";
                if ($validators->fails()){
                    $errorMessage = $validators->messages();
                    foreach($errorMessage->all() as $messages){
                        $errors .= $messages. "<br>";
                    }
                }else{
                    $date = date_create($startDate);
                    $postObject = new Post();
                    $errors .= $postObject->updatePost( $id,$title, $date, $preview, $description );
                    if ($errors == "") {
                        return Redirect::to('personal');
                    }
                }

                return View::make('postEdit', array('post' => $post, 'errors' => isset($errors) ? $errors : null));
            }else{
                return View::make('postEdit', array('post' => $post, 'errors' => isset($errors) ? $errors : null));
            }
        }
    }

    /**
     * Controller public function for delete post by id
     *
     * @param integer $id post id
     *
     * @return redirect to back page;
     */
    public function postDelete($id){
        $post = new Post();
        $singlePost = $post->deletePost($id);
        return Redirect::back();
    }


}