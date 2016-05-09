<?php namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
//use Session;

class Admin {
    
    protected $auth;
    
    public function __construct(Guard $auth)
    {
            $this->auth = $auth;
    }
    
    public function handle($request, Closure $next)
    {
            if ($this->auth->user()->id != 12)
            {
//                Session::put('messageError', 'No es administrador.');
                return redirect('auth/login'); 
                    
            }

            return $next($request);
    }
}
