<nav id="sidebar" class="px-4 py-4 relative">
    <div>
        <button type="button" id="sidebarCollapse" class="mt-2 mr-3 text-white text-2xl  absolute pin-t pin-r mt-4 mr-4">
            <i class="icon-List_1_x40_2xpng_2"></i>
        </button>
        {!! switch_url(true) !!}
    </div>

    <div class="sidebar-header mb-6 text-center mt-10">
        <img src="{{ asset('img/logo_big.png') }}" width="90" height="79" alt="">
    </div>

    <div class="text-white flex">
        <img class="rounded-full w-10 h-10 mr-2"
             src="{{ auth()->user()->profile_picture }}"
             alt="{{auth()->user()->name}}">

        <div>
            <div class="text-bold mb-2 hide-min ">{{auth()->user()->name}}</div>
            <div class="text-grey-dark text-base hide-min">Location: Amman</div>
        </div>
    </div>

    <ul class="list-unstyled components list-reset">

        <li class="uppercase  text-white {{ request()->routeIs('home') ?'active' :''}} ">
            <a href="{{route('home')}}" class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                <i class="icon-Presentation_3_1 min-w-30 text-2xl mr-10 ml-3"></i>
                <span class="sm:text-xs xl:text-base">{{__('irc.dashboard')}}</span>
            </a>
        </li>

        @if(\Auth::user()->hasPermissionTo('cases.job-seeker'))
            <li class="uppercase  text-white {{ request()->is('*job-seekers*') ?'active' :''}} ">
                <a href="{{route('job-seekers')}}"
                   class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                    <i class="icon-Users_2_x40_2xpng_2 min-w-30  text-2xl mr-10 ml-3"></i>
                    <span class="sm:text-xs xl:text-base">{{__('irc.all_job_seekers')}}</span>
                </a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('cases.firm'))
            <li class="uppercase  text-white {{ request()->is('*firms*') ?'active' :''}}">
                <a href="{{route('firms')}}" class="text-white text-sm flex items-center remove-text-minified   py-4 relative mb-3">
                    <i class="icon-Storefront_x40_2xpng_2 min-w-30 pin-l pin-t text-xl mr-10 ml-3"></i>
                    <span class="sm:text-xs xl:text-base">{{__('irc.employers')}}</span>
                </a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('cases.job-opening'))
            <li class="uppercase  text-white {{ request()->is('*job-openings*') ?'active' :''}}">
                <a href="{{route('job-openings')}}"
                   class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                    <i class="icon-Briefcase_x40_2xpng_2 min-w-30  pin-l pin-t text-xl mr-10 ml-3"></i>
                    <span class="sm:text-xs xl:text-base">{{__('irc.jobs')}}</span>
                </a>
            </li>
        @endif

        <li class="uppercase  text-white {{  request()->is('*users*') ?'active' :''}}">
            <a href="{{route('users')}}"
               class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                <i class="icon-Briefcase_x40_2xpng_2 min-w-30  pin-l pin-t text-xl mr-10 ml-3"></i>
                <span class="sm:text-xs xl:text-base">{{__('irc.users')}}</span>
            </a>
        </li>


        <li class="uppercase  text-white">

            <a class="text-white text-sm flex items-center remove-text-minified py-4 relative mb-3"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class=" min-w-30 icon-Lock_x40_2xpng_2  pin-l pin-t text-2xl mr-10 ml-3"></i>
                <span class="sm:text-xs xl:text-base">{{__('irc.logout')}}</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</nav>


@section('script')

@endsection
