<?php 

namespace App\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;
/**
* 
*/
class MatchesPasswordException extends ValidationException
{
	
	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Les mots de passes saisies ne correspondent pas',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} correspondent',
        ]
    ];
}