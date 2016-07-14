<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;
use SplTempFileObject;

class PickFifty extends Command
{
    protected $signature = 'pick:fifty';

    protected $description = 'Pick fifty';

    public function handle()
    {
        $reader = Reader::createFromPath(storage_path('app/signups.csv'));

        // Skip the header
        $all = $reader->setOffset(1)->fetchAll();

        /* Each entry is shaped like this:
         *
         * [
         *     0 => "x",
         *     1 => "Jill Schmidt" // name
         *     2 => "jill@schmidt.com" // email
         *     3 => "4" // experience level w/laravel 1-5
         *     4 => "Stuff" // things I'd like to learn
         * ]
         */

        // Filter and grab 50 randomly
        $winners = collect($all)->filter(function ($person) {
            // Manually added an 'x' next to anyone whose story/reason was compelling;
            // turns out I "x'ed" 84 people, which is more than 50, so we're just gonna
            // use only them 
            return $person[0] == 'x';
        })->random(50);

        // Write
        $writer = Writer::createFromFileObject(new SplTempFileObject);
        $writer->insertAll($winners->map(function ($winner) {
            return [
                'name' => $winner[1],
                'email' => $winner[2]
            ];
        }));

        Storage::put('winners.csv', $writer);
    }
}
