<?php namespace App\Repositories\PropertyOption;

use App\Models\PropertyOption;
use Illuminate\Support\Facades\Cache;

class PropertyOptionRepository implements PropertyOptionRepositoryInterface
{

    public function CommCareAndPropertyIs($commCareId, $propertyId)
    {
        $cacheName = $this->cacheName(['CommCareAndPropertyIs', $commCareId, $propertyId]);

        return Cache::driver('array')->rememberForever($cacheName, function () use ($commCareId, $propertyId, $cacheName) {
            $result = PropertyOption::where('commcare_id', $commCareId)->where('property_meta_data_id', $propertyId)->first();

            return !$result ? false : $result;
        });
    }


    protected function cacheName($postfix): string
    {
        if (is_array($postfix)) {
            $postfix = implode('_', $postfix);
        }

        return static::class . '_' . $postfix;
    }
}