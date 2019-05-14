<?php namespace App\Http\Resources\CaseResources;

use App\Http\Resources\CaseDataResource;
use App\Models\Firm;
use App\Repositories\PropertyMetaData\PropertyMetaDataRepositoryInterface;
use Illuminate\Support\Collection;

class JobOpeningResourceCollection extends CaseDataResource
{
    public $collects = JobOpeningResource::class;

    public function with($request)
    {
        $with = parent::with($request);

        foreach ($with['filters'] as $index => $filter) {
            if ($filter['name'] === 'firm_id') {
                $with['filters'][$index]['options'] = Firm::all()->map(function ($firm) {
                    return [
                        'label' => $firm->firm_name,
                        'value' => $firm->id
                    ];
                });
            } elseif ($filter['name'] == 'firm_city') {
                $with['filters'][$index]['options'] = $this->firmCityOptions();
            }
        }

        $with['headers'] = array_insert_after(
            $with['headers'],
            array_search_key_by_value($with['headers'], 'name', 'num_vacancies'),
            [
                [
                    'label' => trans('irc.hired_matches_count'),
                    'name' => 'hired_matches_count'
                ]
            ]
        );


        $with['permissions'] = array_get($with, 'permissions', []);

        return $with;
    }

    public function insert($array, $insertedArray)
    {
        $array1 = array_slice($array, 0, 3, true);
        $array2 = array_slice($array, 3, count($array) - 1, true);

        return $array1 + $insertedArray + $array2;
    }

    private function firmCityOptions()
    {

        $firmCities = app(PropertyMetaDataRepositoryInterface::class)->typeIs('job-seeker')->where('commcare_id', 'city')->first();

        if (!$firmCities) {
            return;
        }

        $options = $firmCities->attributes['options'] ?? [];

        $options = collect($options)->mapInto(Collection::class)->map->only(['label', 'value'])->toArray();

        return $options;

    }
}