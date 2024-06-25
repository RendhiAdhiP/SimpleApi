<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //token dia ambil dari request header
        $token = $request->header('Authorization');

        //nilai awal autenticate adalah true
        $authenticate = true;

        //jika token tidak ada maka nilai $authenticate di set menjadi false
        if(!$token){
            $authenticate = false;
        }

        $user = User::where('token', $token)->first();
        if(!$user){
            $authenticate = false;   
        }

        Auth::login($user);

        if($authenticate){
            return $next($request);
        }else{
            return response()->json([
                "errors"=>[
                    "messsage"=>[
                        "unauthorized"
                    ]
                ]
            ])->setStatusCode(401);
        }
    }
}
