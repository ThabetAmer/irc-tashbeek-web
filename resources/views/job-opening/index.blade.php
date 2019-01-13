@extends('layouts.layout')
@section('content')
    <div class="" id="all-firms">
        <case-listing type="job-opening">
            <template
                    slot="end-td"
                    slot-scope="{row}"
            >
                <a :href="`/job-openings/${row.id}/match`">
                    Match
                </a>
            </template>
        </case-listing>
    </div>
@endsection

