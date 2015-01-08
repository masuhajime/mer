<?php namespace Mer\Controller;

use \Parse\ParseClient;
use \Parse\ParseQuery;

class Ranking extends \Controller {

    public function show($app_name, $ranking_name)
    {
        // 形だけ作りたいのでこれで...
        if ($app_name !== 'ninja' || $ranking_name !== 'maruta') {
            return \View::make('rankings.ranking_error', [
                'error' => "error is this",
            ]);
        }
        
        ParseClient::initialize(
                \Config::get('parse.ninja_jump.application_id'),
                \Config::get('parse.ninja_jump.rest_api_key'),
                \Config::get('parse.ninja_jump.master_key')
                );
        $query = new ParseQuery('MarutaRecord');
        $records = $query->descending("score")->limit(100)->find();
        
        return \View::make('rankings.ranking_show', [
            'records' => $records,
        ]);
    }

}
