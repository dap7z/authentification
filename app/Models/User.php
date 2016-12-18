<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Classe représentant un utilisateur en bdd
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
	
	//on defini les champs qui ne doivent pas être retourne par defaut dans les methodes get/all
	protected $hidden = ['password'];

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password,PASSWORD_DEFAULT)
		]);
	}
}