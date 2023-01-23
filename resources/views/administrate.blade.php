@if (Auth::check())
    
    @if (Auth::user()->role == 'poweruser' || Auth::user()->role == 'admin')
        
        <table>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>email</th>
                <th>phonenumber</th>
                <th>role</th>
                <th>password</th>
                <th>created_at</th>

            </tr>
            @foreach (DB::table('users')->get() as $user)
                <tr>
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <td>{{ $user->id }}</td>
                        <td><input type="text" name="username" value="{{ $user->username }}"></td>
                        <td><input type="text" name="firstname" value="{{ $user->firstname }}"></td>
                        <td><input type="text" name="lastname" value="{{ $user->lastname }}"></td>
                        <td><input type="text" name="email" value="{{ $user->email }}"></td>
                        <td><input type="text" name="phonenumber" value="{{ $user->phonenumber }}"></td>
                        @if (Auth::user()->role == 'admin')
                        <td><select name="role">
                            <option value="{{ $user->role }}">{{ $user->role }}</option> 
                        @if ($user->role != 'poweruser')
                            <option value="poweruser">poweruser</option>
                        @endif
                        @if ($user->role != 'user')
                            <option value="user">user</option>
                        @endif
                        @if ($user->role != 'admin')
                            <option value="admin">admin</option>
                        @endif
                        </select></td>
                        @elseif ($user->role != 'admin') {
                            <td><select name="role"><option value="{{ $user->role }}">{{ $user->role }}</option> @if ($user->role != 'poweruser')
                                <option value="poweruser">poweruser</option></select></td>
                                @else {
                                    <option value="user">user</option></select></td>
                                }
                                @endif 
                        }
                        @else
                            <td><select name="role"><option value="admin">admin</option></select></td>
                        @endif
                        <td><input type="text" name="password" value="{{ $user->password }}"></td>
                        <td>{{ $user->created_at }}</td>
                        <td><button type="submit">Submit changes</button></td>
                    </form>
                    <form action="{{ route('profile.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @if ($user->role != 'admin' && Auth::user()->role == 'admin')
                        <td><button type="submit">Delete</button></td>
                        @elseif ($user->role != 'admin' && $user->role != 'poweruser')
                        <td><button type="submit">Delete</button></td>
                        @endif
                    </form>
                </tr>
            @endforeach
      </table>

    @else
        <body style="background-color: green">
        
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
    
        <a href="{{ route('administrate') }}">test</a>
    
        {{ Auth::user()->role }}
    
    
        </body>
        
    @endif
    
@endif


