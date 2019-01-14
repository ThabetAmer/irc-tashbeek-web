@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All job openings', link:'job-openings'}]"
    ></breadcrumbs>
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

