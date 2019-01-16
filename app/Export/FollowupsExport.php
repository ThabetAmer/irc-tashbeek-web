<?php


namespace App\Export;

use Maatwebsite\Excel\Facades\Excel;

class FollowupsExport extends Export
{


    /**
     * @return array|mixed
     */
    public function getHeaders()
    {
        return [
            'ID',
            'Followup Type',
            'Followup Date',
            'Followup Period',
            'Followup Name',
        ];
    }


    /**
     * @return array|mixed
     */
    public function getData()
    {
        $followups = $this->data->toArray(request());

        $followups = array_map(function ($item) {
            return array_merge(
                array_only($item, ['id', 'followup_type', 'followup_date', 'followup_period']),
                [
                    'followup_name' => data_get($item, 'followup.name'),
                ]
            );
        }, $followups);

        return $followups;
    }


}
