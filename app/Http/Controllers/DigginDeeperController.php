<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class DigginDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        /**
         * @var Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        // dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        /**
         * @var Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

        //dd(get_class($eloquentCollection), get_class($collection), $collection);

        // $result['first'] = $collection->first();
        // $result['last'] = $collection->last();

        // dd($result);

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');

        // dd($result);

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        dd($result);

        //Не очень красиво
        // if ($result['where']['count']) {
        //     # code...
        // }

        //Так лучше
        // if ($result['where']['count']->isNotEmpty()) {
        //     # code...
        // }

        $result['where_first'] = $collection->firstWhere('created_at', '>', '2019-01-10 02:40:45');

        // dd($result);

        //Базовая переменная не изменится, просто вернется измененная версия
        $result['map']['all'] = $collection->map(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);

            return $newItem;
        });

        // dd($result);

        $result['map']['not_exists'] = $result['map']['all']
            ->where('exists', '=', 'false')
            ->values()
            ->keyBy('item_id');

        // dd($result);

        //Базовая переменная изменится (трансформируется)
        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

        $newItem = new \stdClass();
        $newItem->id = 9999;

        $newItem = new \stdClass();
        $newItem->id = 8888;
        
        // dd($result);
    }
}
