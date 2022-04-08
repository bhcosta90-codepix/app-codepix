<?php

namespace App\Http\Middleware;

use App\Models\Bank;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $credential = $request->header('Authorization');

        if (empty($credential)) {
            abort(403, __('You are not authorized to this action'));
        }

        list(,$credential) = explode(' ', $credential);

        list($credential, $secret) = explode(':', $credential);

        $objBank = Bank::where('credential', $credential)->first();

        if($objBank->secret != sha1($secret)) {
            abort(403, __('You are not authorized to this action'));
        }

        Auth::login($objBank);

        return $next($request);
    }
}
