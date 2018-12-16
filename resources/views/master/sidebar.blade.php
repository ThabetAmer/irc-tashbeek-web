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
            <a href="/dashboard" class="text-white remove-text-minified  pl-20 py-5 relative mb-3">
                <i class="fas fa-chart-line absolute pin-l pin-t text-2xl mt-4 ml-3"></i>
                Dashboard

            </a>
        </li>

        <li class="uppercase  text-white ">
            <a href="/seeker" class="text-white remove-text-minified  pl-20 py-5 relative mb-3">
                <i class="fas fa-users absolute pin-l pin-t text-2xl mt-4 ml-3"></i>
                All job seekers

            </a>
        </li>

        <li class="uppercase  text-white">
            <a href="" class="text-white remove-text-minified  pl-20 py-5 relative mb-3">
                <i class="fas fa-briefcase absolute pin-l pin-t text-2xl mt-4 ml-3"></i>
                Jobs

            </a>
        </li>

        <li class="uppercase  text-white">
            <a href="" class="text-white remove-text-minified  pl-20 py-5 relative mb-3">
                <i class="fas fa-store absolute pin-l pin-t text-2xl mt-4 ml-3"></i>
                Employers

            </a>
        </li>

        <li class="uppercase  text-white">
            <a href="" class="text-white remove-text-minified  pl-20 py-5 relative mb-4">
                <i class="fas fa-lock absolute pin-l pin-t text-2xl mt-4 ml-3"></i>
                Sign out

            </a>
        </li>

    </ul>
</nav>


@section('script')

    </script>
@endsection
