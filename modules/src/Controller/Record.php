<?php namespace Mer\Controller;

class Record extends \Controller {

    public function update($app_name, $ranking_name)
    {
        $uuid = \Input::get('uuid');
        $score = \Input::get('score');
        try {
        \Mer\Service\Record::update($app_name, $ranking_name, $uuid, $score);
        } catch (\Exception $e) {
            return \Response::json([
                'meta' => [
                    'status' => 500,
                ],
                'response' => [
                    'result' => 'fail',
                    'reason' => $e->getMessage(),
                ],
            ]);
        }
        return \Response::json([
            'meta' => [
                'status' => 200,
            ],
            'response' => [
                'result' => 'success',
            ],
        ]);
    }

}
