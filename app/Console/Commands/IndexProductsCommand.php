<?php

namespace App\Console\Commands;

use App\Jobs\IndexProductJob;
use App\Product;
use App\Store;
use Illuminate\Console\Command;

class IndexProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index the products in Elasticsearch';

    protected int $chunkSize = 100;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Store::all() as $store) {
            $this->line('Store: '.$store->name);
            config()->set('shop.store', $store->store_id);
            $productQuery = Product::where('visibility', 4);

            if (config('queue.default') == 'sync') {
                $bar = $this->output->createProgressBar($productQuery->count());
                $bar->start();
            }

            $productQuery->chunk($this->chunkSize, function ($products) use ($store, $bar) {
                foreach ($products as $product) {
                    $data = ['store' => $store->code];
                    foreach (config('shop.index.attributes') as $attribute => $key) {
                        $data[$key] = $product->$attribute;
                    }
                    IndexProductJob::dispatch($data);
                }

                if (config('queue.default') == 'sync') {
                    $bar->advance(100);
                }
            });

            if (config('queue.default') == 'sync') {
                $bar->finish();
            }
            $this->info("\nDone!");
        }
    }
}
