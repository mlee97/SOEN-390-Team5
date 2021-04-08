<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="/">ERP System</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!--Navbar content-->
            <ul class="navbar-nav">

                <!--Redirects to home page-->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                <!--Redirects to User Management page if the user has permission-->
                @if(Auth::user()->user_type==0)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('user.management')}}">User Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('logging.main')}}">Logs</a>
                </li>
                @endif

                @if(Auth::user()->user_type==3)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('shipping')}}">Shipping</a>
                </li>
                @endif

                <!--Redirects to Inventory page if the user has permission--><!--Permissions to be implemented-->

                @if(Auth::user()->user_type==4 || Auth::user()->user_type==7 )
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('inventory')}}">Inventory</a>
                </li>
                @endif

                @if(Auth::user()->user_type==5 || Auth::user()->user_type==9)
                <!--Redirects to Job page if the user has permission-->
                <li class="nav-item">
                    <a class="nav-link active" href="/jobs">Jobs</a>
                </li>

                <!--Redirects to Machine page if the user has permission-->
                <li class="nav-item">
                    <a class="nav-link active" href="/machine-status">Machine Status</a>
                </li>
                @endif

                @if(Auth::user()->user_type==5)
                <!--Redirects to Assembly page if the user has permission-->
                <li class="nav-item">
                    <a class="nav-link active" href="/assembly">Assembly</a>
                </li>
                @endif
                
                @if(Auth::user()->user_type==6)
                <!--Redirects to Accountant page if the user has permission-->
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('accountant')}}">Accountant</a>
                </li>
                @endif
                
                @if(Auth::user()->user_type==8)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('sales')}}">Sales</a>
                </li>
                @endif

                @if(Auth::user() != null)

               


                <!--Logs users out-->
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/logout")}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout </a>

                    <form id="logout-form" action="{{url('/logout')}}" method="POST">
                        {{csrf_field()}}
                    </form>
                </li>
                @endif
            </ul>
            <!--End of navbar content-->

            <!--Display current user-->
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
