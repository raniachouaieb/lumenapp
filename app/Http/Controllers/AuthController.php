<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){

        $this->validate($request, [
            'email' => 'required|unique:users' 
        ]);

        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role');

        User::create([
        'name' =>$name,
        'email' =>$email,
         'password' =>$password,
          'role' =>$role]);
         
        return response()->json(['status' => 'success', 'operation' => 'created']);
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if ( $token = auth()->attempt($credentials)) {
            $response=[
                'user'->auth()->user(),
                'token'=>[
                    'type'=>'Bearer',
                    'value'=>$token,
                    'expires_at'=>auth()->factory()->getTTL(),
                ]
                ];
            
           
            return $this->$response;
            
        }
        return response()->json([ 'error'=>'Invalid email or password'], 401);

     
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
   
}