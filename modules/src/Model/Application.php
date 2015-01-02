<?php namespace Mer\Model;

class Application extends \Eloquent {
    use \Mer\Model\Eloquent\TraitExpandEloquent;

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title'];

}
