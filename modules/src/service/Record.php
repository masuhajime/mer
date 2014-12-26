<?php namespace Mer\Service;

use Mer\Model\Application;
use Mer\Model\Ranking;

class Record {

    static public function update(Application $application, Ranking $ranking)
    {
        $record = \Mer\Model\Record::where('application_id', $application->id)
            ->where('ranking_id', $ranking->id)
            ->first();
        $record->uuid = 'uuid';
        $record->score = 123;
        $record->save();
    }

}
