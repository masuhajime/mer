<?php

Route::get('/app/{app_name}/ranking/{ranking_name}', '\Mer\Controller\Ranking@show');
Route::post('/app/{app_name}/ranking/{ranking_name}/post', '\Mer\Controller\Record@update');
// todo:rankingに降順昇順の機能をつけたい
