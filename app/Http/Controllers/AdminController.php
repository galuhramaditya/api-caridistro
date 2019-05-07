<?php 

namespace App\Http\Controllers;

use App\Admin;
use Hash;
use Request;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin', [
			'except' => ['login']
		]);
		$this->middleware('admin.super', [
			'only' => ['create', 'updateSuper', 'delete']
		]);
		$this->middleware('admin.password', [
			'only' => ['update', 'updateSuper', 'delete']
		]);
		$this->middleware('notoken', [
			'only' => ['login']
		]);
	}

	public function login(Request $request)
	{
		$admin = Admin::where('username', $request->username)->first();
		if(!empty($admin)) {
			if(Hash::check($request->password, $admin->password)) {
				return response()->json([
					'token'	=> $this->jwt($admin->id, 'admin')
				]);
			}
			setcookie('data', 'qwrertwetwet');
			return response()->json(['password' => 'password is wrong'], 401);
		}
		return response()->json(['username' => 'username is not exist'], 401);
	}

	public function create(Request $request)
	{
		$this->validate($request, [
			'username'	=> 'required|max:20|unique:admin',
			'password'	=> 'required|max:16|min:8',
			'password_confirmation'	=> 'required|same:password'
		]);

		Admin::create([
			'username'	=> $request->username,
			'password'	=> Hash::make($request->password),
		]);

		return response('success');
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'username'		=> 'required|max:20|unique:admin,username,' . $request->token->id,
			'new_password'	=> 'required|max:16|min:8',
			'new_password_confirmation'	=> 'required|same:password'
		]);

		Admin::find($request->token->id)->update([
			'username'	=> $request->username,
			'password'	=> Hash::make($request->new_password),eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU4Yjk1ODdhLWJhMjMtNDdhMy04ZDA5LTMzMzUxY2M0MTY1MyIsImlhdCI6MTU1NDQwMzg3OCwicGVybXMiOiJhZG1pbiJ9.NaWLg4Ml4RVfLlyy39HuHhpGxlHaJPY886ztUzFM9uE
		]);
		return response('success');
	}

	public function updateSuper(Request $request)
	{
		if ($request->id == $request->token->id) {
			return response('can\'t update own self', 401);
		}

		$admin = Admin::find($request->id);
		if ($admin) {
			$admin->update([
				'super' => $request->super,
			]);
			return response('success');
		}
		return response('id is not exist', 401);
	}

	public function delete(Request $request)
	{
		if ($request->id == $request->token->id) {
			return response('can\'t delete own self', 401);
		}

		$admin = Admin::find($request->id);
		if ($admin) {
			$admin->delete();
			return response('success');
		}
		return response('id is not exist', 401);
	}

	public function getData(Request $request)
	{
		$select = ['username', 'created_at', 'updated_at'];
		if (Admin::find($request->token->id)->super == 1) {
			array_unshift($select, 'id', 'super');
		}

		$admin = Admin::select($select);
		if ($request->input()) {
			$admin->where($request->input());
		}
		var_dump($_COOKIE['data']);
		return $admin->get();
	}
}
