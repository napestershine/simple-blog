<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * Controller public function authorization  user
     *
     * @return redirect to home or view login auth.login.blade.php
     */
    public function login(){
        if(Auth::check()) {
            return Redirect::intended('personal');
        }

        $user = new User();
        if(Input::has('login')){
            $login = Input::get('login');
            $password = Input::get('password');
            $remember = Input::has('remember') ? true : false;

            $validators = Validator::make(
                array(
                    'login' => $login,
                    'password' => $password,

                ),
                array(
                    'login' => 'required|min:2|max:30',
                    'password' => 'required|min:2|max:30',
                )
            );
            $errors = "";
            $success = "";
            if ($validators->fails()){
                $errorMessage = $validators->messages();
                foreach($errorMessage->all() as $messages){
                    $errors .= $messages. "<br>";
                }
            }else{
                if (Auth::attempt(['login' => $login, 'password' => $password], $remember, true)){
                    return Redirect::intended('personal');
                }else{
                    $errors="error login or password";
                }
            }
        }
        return View::make('auth.login', array('title' => 'User sign up',
            'errors' => isset($errors) ? $errors : null ,
            'success' => isset($success) ? $success : null ));
    }

    /**
     * Controller public function registration user
     *
     * @return redirect to home or view register form auth.registration.blade.php
     */
    public function registration(){
        if(Auth::check()) {
            return Redirect::intended('personal');
        }

        $user = new User();
        if(Input::has('login')){
            $name = Input::get('name');
            $login = Input::get('login');
            $password = Input::get('password');

            $validators = Validator::make(
                array(
                    'name' => $name,
                    'login' => $login,
                    'password' => $password,
                    'password_confirmation' => Input::get('password_confirmation'),
                ),
                array(
                    'name' => 'required|min:2|max:30',
                    'login' => 'required|unique:users,login|min:2|max:30',
                    'password' => 'required|confirmed||min:2|max:30',
                    'password_confirmation' => 'same:password',
                )
            );
            $errors = "";
            $success = "";
            if ($validators->fails()){
                $errorMessage = $validators->messages();
                foreach($errorMessage->all() as $messages){
                    $errors .= $messages. "<br>";
                }
            }else{
                $user->fill(Input::all());
                if($user->signup()) {
                    if (Auth::attempt(['login' => $login, 'password' => $password], true, true)) {
                        return Redirect::intended('personal');
                    }
                }
            }
        }
        return View::make('auth.registration', array('title' => 'Registration user',
            'errors' => isset($errors) ? $errors : null ,
            'success' => isset($success) ? $success : null )
        );
    }
}