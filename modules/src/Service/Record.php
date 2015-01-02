<?php namespace Mer\Service;

use Mer\Model\Application;
use Mer\Model\Ranking;

class Record {

    static public function update($application_name, $ranking_name, $uuid, $score)
    {
        $validator = \Mer\Model\Record::getValidator([
            'uuid' => $uuid,
            'score' => $score,
        ]);
        if ($validator->fails()) {
            throw new \RuntimeException("validation failed");
        }
        $app = \Mer\Model\Application::firstByAttributesOrFail([
            'name' => $application_name,
        ]);
        $ranking = \Mer\Model\Ranking::firstByAttributesOrFail([
            'application_id' => $app->id,
            'name' => $ranking_name,
        ]);
        $record = \Mer\Model\Record::firstOrNew([
            'application_id' => $app->id,
            'ranking_id' => $ranking->id,
            'uuid' => $uuid,
        ]);
        // :TODO 固定で降順としているのでrankingテーブルに昇順/降順のカラムを追加したい
        if ($score > $record->score) {
            $record->score = $score;
        }
        if ($record->save()) {
            return true;
        }
        throw new \RuntimeException("record update failed");
    }

}
