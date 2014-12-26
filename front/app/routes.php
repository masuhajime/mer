<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('app', 'ApplicationsController');

Route::get('/app/{app_name}/ranking/{ranking_name}', function($app_name, $ranking_name)
{
	return $app_name."/".$ranking_name;
});

Route::get('/app/{app_name}/ranking/{ranking_name}/post', function($app_name, $ranking_name)
{
	//return "post:".$app_name."/".$ranking_name;
	/*
	$app = new \Mer\Model\Application();
	$app->id = 1;
	$app->save();
	*/
	$app = \Mer\Model\Application::firstOrNew(['title' => 'ninja34']);
	//var_dump($app); exit;
	//$app = \Mer\Model\Application::findOrNew()->where();
	//$app->title = "ninja4";
	//$app->save();
	//\Mer\Service\Record::update();
	//return $app->id."/".$app->title;
	//return "ok";
});

