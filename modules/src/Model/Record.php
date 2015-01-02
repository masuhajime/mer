<?php namespace Mer\Model;

class Record extends \Eloquent {
    use \Mer\Model\Eloquent\TraitExpandEloquent;

	// Add your validation rules here
	public static $rules = [
		'application_id' => 'numeric',
		'ranking_id' => 'numeric',
		'uuid' => 'required|between:1,255',
		'score' => 'required|numeric',
	];

	// Don't forget to fill this array
	protected $fillable = [
        'application_id',
        'ranking_id',
        'uuid',
    ];

}
