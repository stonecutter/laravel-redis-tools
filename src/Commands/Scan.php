<?php

namespace stonecutter\LaravelRedisTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\Facades\Redis;

class Scan extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:scan {--match=} {--count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan keys';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('start');
        $match = $this->option('match');
        $count = $this->option('count');

        $cursor = 0;
        $total = 0;
        while (list($cursor, $keys) = Redis::scan($cursor, ['MATCH' => $match, 'COUNT' => $count])) {
            $this->info('loop, ' . json_encode(['cursor' => $cursor, 'keys_count' => count($keys)]));
            if (!empty($keys)) {
                $total += count($keys);
            }
            if (!$cursor) {
                $this->info('no more keys');
                break;
            }
        }
        $this->info('end, ' . json_encode(['total' => $total]));
    }
}
