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
                <a class="no-underline text-green mr-2 text-xl" :href="`/job-openings/${row.id}/match`">
                    <i class="icon-Magnify_Glass_x40_2xpng_2"></i>
                </a>
            </template>
        </case-listing>
    </div>
@endsection

