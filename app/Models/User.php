<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class User extends Model
{
	
	protected $table = 'users';

	//on defini les champs modifibles par l'utilisateur :
	protected $fillable = [
		'email',
		'password',
		'telnumber',
		'name',
		'surname',
	];

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password,PASSWORD_DEFAULT)
		]);
	}
}