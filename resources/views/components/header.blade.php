<header class="bg-blue-900 text-white p-4" x-data="{open:false}">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{url("/")}}">Workopia</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
           <x-nav-link icon="" href="{{url('/')}}" :active='request()->is("/")'>
               Home
           </x-nav-link>

            <x-nav-link url="/job" :active="request()->is('jobs')">All Jobs</x-nav-link>

            @auth

            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')">Saved Jobs</x-nav-link>
{{--            <x-nav-link url="/dashboard" :active="request()->is('/dashboard')">Dashboard</x-nav-link>--}}
            <x-button-logout />
            <x-button-link url="/job/create">
                Create Job
            </x-button-link>

                <div class="flex items-center space-x-3">
                    <a href="{{route("dashboard")}}">
                        @if(Auth::user()->avatar)
                            <img src="{{asset("storage/".Auth::user()->avatar)}}"
                                 class="w-10 h-10 rounded-full"
                                 alt="user pic">
                        @else
                            <img src="{{asset("storage/avatars/default-avatar.png")}}"
                                 class="w-10 h-10 rounded-full"
                                 alt="def pic">
                        @endif
                    </a>

                </div>
            @else
                <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open" id="hamburger2" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>

    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" id="mobile-menu"
         class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">
        <x-nav-link icon="" url='/job' :active='request()->is("/job")' :mobile="true">
            All Jobs
        </x-nav-link>
        @auth

            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>
{{--            <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashbaord</x-nav-link>--}}
            <x-button-logout/>
            <x-button-link url='/jobs/create' icon='edit' :block="true">Create Job
            </x-button-link>

            <div class="flex items-center space-x-3">
                <a href="{{route("dashboard")}}">
                    @if(Auth::user()->avatar)
                        <img src="{{asset("storage/".Auth::user()->avatar)}}"
                             class="w-10 h-10 rounded-full"
                             alt="user pic">
                    @else
                        <img src="{{asset("storage/avatars/default-avatar.png")}}"
                             class="w-10 h-10 rounded-full"
                             alt="def pic">
                    @endif
                </a>

            </div>

        @else
            <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth



    </nav>
</header>
