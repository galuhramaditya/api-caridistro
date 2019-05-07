<?php 

namespace App\Http\Controllers;

use Request;
use Socialite;
use Session;

class ProviderController extends Controller
{
	public function redirect($provider)
	{
		try {
			session_start();
			$_SESSION['data'] = $provider;
			return Socialite::driver($provider)->stateless()->with(['orang' => 'ya'])->redirect();
		} catch (\Exception $e) {
			return response('provider is not supported', 400);
		}
	}

	public function callback(Request $request, $provider)
	{
		session_start();
		//var_dump($_SESSION['data']);
		session_destroy();
		return response()->json(Socialite::driver($provider)->stateless()->user());
	}
}
