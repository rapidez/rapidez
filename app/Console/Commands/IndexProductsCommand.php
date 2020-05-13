<?php

namespace App\Console\Commands;

use App\Models\Attribute;
use App\Jobs\IndexProductJob;
use App\Models\Product;
use App\Models\Store;
use Cviebrock\LaravelElasticsearch\Manager as Elasticsearch;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use TorMorten\Eventy\Facades\Eventy;

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

    protected int $chunkSize = 500;

    protected Elasticsearch $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Elasticsearch $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
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

            $this->createIndexIfNeeded('products_' . $store->store_id);

            $productQuery = Product::where('visibility', 4)->selectOnlyIndexable();

            $scopes = Eventy::filter('index.product.scopes') ?: [];
            foreach ($scopes as $scope) {
                $productQuery->withGlobalScope($scope, new $scope);
            }

            $bar = $this->output->createProgressBar($productQuery->count());
            $bar->start();

            $productQuery->chunk($this->chunkSize, function ($products) use ($store, $bar) {
                foreach ($products as $product) {
                    $data = array_merge(['store' => $store->store_id], $product->toArray());
                    $data = Eventy::filter('index.product.data', $data, $product);
                    IndexProductJob::dispatch($data);
                }

                $bar->advance($this->chunkSize);
            });

            $bar->finish();
            $this->line('');
        }
        $this->info('Done!');
    }

    public function createIndexIfNeeded(string $index): void
    {
        try {
            $this->elasticsearch->cat()->indices(['index' => $index]);
        } catch (Missing404Exception $e) {
            $this->elasticsearch->indices()->create([
                'index' => $index,
                'body'  => [
                    'mappings' => [
                        'properties' => [
                            'price' => [
                                'type' => 'double',
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }
}
