<?php
namespace App\Service\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{
    public function register(array $data){
        try{
            $user = User::create($data);
            return $user ;
        }catch(Exception $e){
            Log::error('Error When Register user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    public function login(array $data){
        try{
            $credentials = [
                'email'=>$data['email'],
                'password'=>$data['password']
            ];
            if(!$token = Auth::attempt($credentials)){
                return redirect()->back()->with('error','Invalid Credentials');
            }else{
                return $token ;
            }
        }catch(Exception $e){
            Log::error('Error When Login '.$e->getMessage());
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }
    public function logout(){
        try{
            Auth::logout();
        }catch(Exception $e){
            Log::error('Error when logout user '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
}
