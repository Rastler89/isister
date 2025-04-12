<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca los artículos como publicados si la fecha es igual o anterior a hoy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $count = Article::where('published',0)
            ->whereDate('published_at','<=',$today)
            ->update(['published'=>1]);

        $this->info("Se han publicado {$count} artículo(s).");

    }
}
