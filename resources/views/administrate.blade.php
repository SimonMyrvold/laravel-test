@if (Auth::check())

    {{-- if user is logged in, check if user is admin or poweruser --}}
    
    @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3')


        
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

            {{-- loop through all users and display them in a table --}}

            @foreach (DB::table('users')->get() as $user)
                <tr>

                    {{-- prints out all users that have a lower role_id than the logged in user and if it's yourself --}}

                    @if (Auth::user()->role_id > $user->role_id || Auth::user()->username == $user->username)

                    {{-- form to update user --}}
                        
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <td>{{ $user->id }}</td>
                        <td><input type="text" name="username" value="{{ $user->username }}"></td>
                        <td><input type="text" name="firstname" value="{{ $user->firstname }}"></td>
                        <td><input type="text" name="lastname" value="{{ $user->lastname }}"></td>
                        <td><input type="text" name="email" value="{{ $user->email }}"></td>
                        <td><input type="text" name="phonenumber" value="{{ $user->phonenumber }}"></td>
                        <td>

                            {{-- if user is user and logged in user is poweruser show user and poweruser as alternetives --}}
                            {{-- if user is user and logged in user is admin show user, poweruser and admin as alternetives --}}
                            {{-- if user is poweruser and logged in user is admin show user, poweruser and admin as alternetives --}}

                            <select name="role_id" id="role_id">
                                @if ($user->role_id == '1' && Auth::user()->role_id == '2')
                                    <option value="1">user</option>
                                    <option value="2">poweruser</option>
                                @endif
                                @if ($user->role_id == '1' && Auth::user()->role_id == '3')
                                    <option value="1">user</option>
                                    <option value="2">poweruser</option>
                                    <option value="3">admin</option>
                                @endif
                                @if ($user->role_id == '2' && Auth::user()->role_id == '3')
                                    <option value="1">user</option>
                                    <option value="2">poweruser</option>
                                    <option value="3">admin</option>
                                @endif
                                @if ($user->role_id == '2' && Auth::user()->role_id == '2')
                                <option value="2">poweruser</option>
                                <option value="1">user</option>
                                @endif
                                @if ($user->role_id == '3' && Auth::user()->role_id == '3')
                                    <option value="3">admin</option>
                                    <option value="1">user</option>
                                    <option value="2">poweruser</option>
                                @endif
                            </select>
                        </td>
                        <td><input type="text" name="password" value="{{ $user->password }}"></td>
                        <td>{{ $user->created_at }}</td>

                        {{-- submit button --}}

                        <td><button type="submit">update</button></td>
                    </form>

                    {{-- form to delete user --}}

                    <form action="{{ route('profile.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <td><button type="submit">delete</button></td>
                    </form>

                    @endif
                    @endforeach
      </table>

    @else
        
      <p>you don't have permission to access administrate</p>
      
      @endif
      
      <a href="{{ route('dashboard') }}">start</a>
@endif


