<?php namespace App\Repositories\PropertyMetaData;

use App\Models\PropertyMetaData;
use Illuminate\Support\Facades\Cache;

class PropertyMetaDataRepository implements PropertyMetaDataRepositoryInterface
{
    public function typeIs(string $type)
    {
        return Cache::driver('array')->rememberForever($this->cacheName(['of_type',$type]), function() use($type){
           return PropertyMetaData::query()
                ->typeIs($type)
                ->orderBy('order')
                ->get();
        });
    }


    protected function cacheName($postfix) : string {
        if(is_array($postfix)){
            $postfix = implode('_', $postfix);
        }
        return static::class . '_' . $postfix;
    }
}