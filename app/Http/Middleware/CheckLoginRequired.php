<?php

namespace App\Http\Middleware;

use App\Models\Pages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        $page = Pages::where('slug',$path)->first();
        
        if(isset($page->is_login) && $page->is_login === 1){
            if(Auth::check()){
                if(isset($page->memberships)){
                    if(isset(Auth::user()->membership_id)){
                        if(in_array(Auth::user()->membership_id, $page->memberships)){
                        return $next($request);
                        }else{
                            Session::flash('error', 'Not Allowed! Please Upgrade Your Membership Plan');
                            return redirect()->route('home');
                        }
                    }else{
                        Session::flash('error', 'Not Allowed! Please Upgrade Your Membership Plan');
                        return redirect()->route('home');
                    }
                }else{
                    return $next($request);
                }
            }else{
                return redirect()->route('front.login');
            }
        }else{
            if(isset($page->memberships)){
                if(!Auth::check()){
                    return redirect()->route('front.login');
                }
                if(isset(Auth::user()->membership_id) && in_array(Auth::user()->membership_id, $page->memberships)){
                    return $next($request);
                }else{
                    Session::flash('error', 'Not Allowed! Please Upgrade Your Membership Plan');
                    return redirect()->route('home');
                }
            }else{
                return $next($request);
            }
        }
    }
}
