<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class IsRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->user_roles > 0){
            return $next($request);
        }
   
        return redirect('home')->with('error',"You don't have admin access.");
    }
}