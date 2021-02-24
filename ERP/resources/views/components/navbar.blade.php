<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">ERP System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @if(Auth::user()->user_type==0)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('user.management')}}">User Management</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('logging.main')}}">Logs</a>
                    </li>
                @endif
                @if(Auth::user() != null)
                <li class="nav-item">
                    <a class="nav-link active" href="/jobs">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/assembly">Assembly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/inventory">Inventory</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/logout")}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout </a>

                    <form id="logout-form" action="{{url('/logout')}}" method="POST">
                        {{csrf_field()}}
                    </form>

                </li>
                @endif




            </ul>

            <ul class="navbar-nav mr-auto" style="position: absolute; right:0;">
                <li class="nav-item active">
                    <a class="nav-link">
                        {{Auth::user()->last_name}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>