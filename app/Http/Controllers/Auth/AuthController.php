<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Service\Auth\AuthService;
use Error;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $registerService ;
    public function __construct(AuthService $registerService){
        $this->registerService = $registerService ;
    }
    /**
     * register Method
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $user = $this->registerService->register($data);
        if($user){ // if success registerd redirect user to login page
            return redirect()->route('login')->with('success','User Registered successfully... now you can logged in website')->with('userInfo',$user);
        }else{ // if failed then redirect user to same page
            return redirect()->route('register')->withErrors(['error'=>'error occured']);
        }
    }
    /**
     * Login Method
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request){
        $data = $request->validated();
        $token = $this->registerService->login($data);
        if($token){
            return redirect()->route('tasks.index')->with('success','user logged in successfully');
        }else{
            return redirect()->back()->withErrors('error','Invalid Credentials');
        }
    }
    /**
     * logout Method
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        $this->registerService->logout();
        return redirect()->route('login')->with('success','user logged out successfully');
    }
}
