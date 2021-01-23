<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/administration') }}">
                {{ config('app.name', 'Contacts') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            @if (!Auth::guest())
                <ul class="nav navbar-nav">
                <li class="" ><a href="/administration/roles">Roles</a></li>
                <li class=""><a href="/administration/users">Users</a></li>
                @if(!empty(Auth::user()->role))
                    @if (Auth::user()->role->name == 'admin')
                        <li><a href="/administration/contacts">Contacts</a></li>
                    @endif
                @endif
                </ul>
            @endif
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                @else
                    <li class="dropdown">
                        <a href="#"  role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
