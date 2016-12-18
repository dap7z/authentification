<?php

namespace App\Auth;

use App\Models\User;
/**
* 
*/
class Auth
{
	public function user()
	{
		return User::find(isset($_SESSION['user']) ? $_SESSION['user'] : '');
	}

	public function check()
	{
		return isset($_SESSION['user']);
	}
	
	public function checkadmin()
	{
		$isAdmin = false;
		if($this->check()){
			$user = User::where('id',$_SESSION['user'])->first();
			$isAdmin = ($user->is_admin == '1');
		}
		return $isAdmin;
	}
	
	public function attempt($email,$password)
	{
		$userModel = new User;
		$user = $userModel->makeVisible('password')->where('email',$email)->first();
		unset($userModel);

		if (!$user) {
			return false;
		}

		if (password_verify($password,$user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}

		return false;
	}

	public function logout()
	{
		unset($_SESSION['user']);
	}
}