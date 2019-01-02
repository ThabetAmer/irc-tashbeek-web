<nav id="sidebar" class="px-4 py-4 relative">
    <button type="button" id="sidebarCollapse" class="mt-2 mr-3 text-white text-2xl  absolute pin-t pin-r mt-4 mr-4">
        <i class="icon-List_1_x40_2xpng_2"></i>
    </button>

    <div class="sidebar-header mb-6 text-center mt-10">
        <img src="{{ asset('img/logo_big.png') }}" width="90" height="79" alt="">
    </div>

    <div class="user-section fhd:pl-24 hd:pl-16 pl-16 text-white mb-6 relative mb-3">
        <div class="text-2xl fhd:text-3xl hd:text-xl text-bold mb-2 hide-min ">Mike Nolan</div>
        <div class="text-grey-dark text-base hide-min">Location: Amman</div>
        <img class="rounded-full absolute pin-l pin-t mt-3 hd:mt-2 ml-1 w-12"
             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC8dqjys69YAcJBCAsXrwVAkdDMI6p3r_xIRRt-XDhuZyp7gNd"
             alt="">
    </div>

    <ul class="list-unstyled components list-reset">

        <li class="uppercase  text-white {{ Request::url() == url('/dashboard') ?'active' :''}} ">
            <a href="/dashboard" class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                <i class="icon-Presentation_3_1 min-w-30 text-2xl mr-10 ml-3"></i>
                <span>
                    Dashboard
                </span>

            </a>
        </li>

        <li class="uppercase  text-white {{ Request::url() == url('/job-seekers') ?'active' :''}} ">
            <a href="/job-seekers"
               class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                <i class="icon-Users_2_x40_2xpng_2 min-w-30  text-2xl mr-10 ml-3"></i>

                <span>
                    All job seekers
                </span>

            </a>
        </li>

        <li class="uppercase  text-white {{ Request::url() == url('/firms') ?'active' :''}}">
            <a href="/firms" class="text-white text-sm flex items-center remove-text-minified   py-4 relative mb-3">
                <i class="icon-Storefront_x40_2xpng_2 min-w-30 pin-l pin-t text-xl mr-10 ml-3"></i>


                <span>
                    Employers
                </span>

            </a>
        </li>

        <li class="uppercase  text-white {{ Request::url() == url('/job-openings') ?'active' :''}}">
            <a href="/job-openings"
               class="text-white flex items-center  text-sm remove-text-minified py-4 relative mb-3">
                <i class="icon-Briefcase_x40_2xpng_2 min-w-30  pin-l pin-t text-xl mr-10 ml-3"></i>
                <span>
                    Jobs
                </span>
            </a>
        </li>


        <li class="uppercase  text-white">

            <a class="text-white text-sm flex items-center remove-text-minified py-4 relative mb-3"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class=" min-w-30 icon-Lock_x40_2xpng_2  pin-l pin-t text-2xl mr-10 ml-3"></i>

                <span>
                    {{ __('Logout') }}
                </span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</nav>

<style>
    .hd\:mt-2 {
        margin-top: -0.5rem;
    }

</style>

@section('script')

@endsection
