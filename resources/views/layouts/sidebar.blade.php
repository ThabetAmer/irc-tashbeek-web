<nav id="sidebar" class="px-4 py-4 relative">
    <button type="button" id="sidebarCollapse" class="mt-2 mr-3 text-white text-2xl  absolute pin-t pin-r mt-4 mr-4">
        <i class="fas fa-align-left"></i>
    </button>

    <div class="sidebar-header mb-16 text-center mt-10">
        <img src="{{ asset('img/logo_big.png') }}" width="90" height="79" alt="">
    </div>

    <div class="user-section fhd:pl-24 hd:pl-16 pl-16 text-white mb-10 relative mb-3">
        <div class="text-2xl fhd:text-3xl hd:text-2xl text-bold mb-2 hide-min ">Reema</div>
        <div class="text-grey-dark text-lg hide-min">Location: Amman</div>
        <img class="rounded-full absolute pin-l pin-t mt-3 hd:mt-2 ml-1" src="https://picsum.photos/40/40" alt="">
    </div>

    <ul class="list-unstyled components list-reset">

        <li class="uppercase active text-white ">
            <a href="/dashboard" class="text-white flex items-center  text-sm remove-text-minified py-5 relative mb-3">
                <i class="fas fa-chart-line text-2xl mr-10 ml-3"></i>
                <span>
                    Dashboard
                </span>

            </a>
        </li>

        <li class="uppercase  text-white ">
            <a href="/job-seekers"
               class="text-white flex items-center  text-sm remove-text-minified py-5 relative mb-3">
                <i class="fas fa-users  text-2xl mr-10 ml-3"></i>

                <span>
                    All job seekers
                </span>

            </a>
        </li>

        <li class="uppercase  text-white">
            <a href="" class="text-white flex items-center  text-sm remove-text-minified py-5 relative mb-3">
                <i class="fas fa-briefcase  pin-l pin-t text-xl mr-10 ml-3"></i>
                <span>
                    Jobs
                </span>

            </a>
        </li>

        <li class="uppercase  text-white">
            <a href="" class="text-white text-sm flex items-center remove-text-minified   py-5 relative mb-3">
                <i class="fas fa-store  pin-l pin-t text-xl mr-10 ml-3"></i>


                <span>
                    Employers
                </span>

            </a>
        </li>

        <li class="uppercase  text-white">

            <a class="text-white text-sm flex items-center remove-text-minified py-5 relative mb-3"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-lock  pin-l pin-t text-2xl mr-10 ml-3"></i>

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


@section('script')

@endsection
