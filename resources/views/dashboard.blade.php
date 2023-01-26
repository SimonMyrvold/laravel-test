@if (Auth::user()->role_id == '1')
    <body style="background-color: green"> </body>
    
    @elseif (Auth::user()->role_id == '2')
    <body style="background-color: blue"> </body>
    <a href="{{ route('administrate') }}">administrate users</a>
    
    @else
    <body style="background-color: red"> </body>
    <a href="{{ route('administrate') }}">administrate users</a>

@endif
    {{ __("You're logged in!") }}
    
    {{ Auth::user()->username }}

    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>