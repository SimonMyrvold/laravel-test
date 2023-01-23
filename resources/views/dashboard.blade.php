@if (Auth::user()->role == 'user')
    <body style="background-color: green"> </body>

@elseif (Auth::user()->role == 'poweruser')
    <body style="background-color: blue"> </body>

@else
    <body style="background-color: red"> </body>

@endif
    {{ __("You're logged in!") }}
    
    {{ Auth::user()->name }}

    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>

    <a href="{{ route('administrate') }}">administrate users</a>

    {{ Auth::user()->role }}