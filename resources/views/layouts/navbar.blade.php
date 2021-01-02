@if (Auth::user())

<style>
    .nav-item {
        background: transparent;
    }

</style>

<nav class="navbar narbar-dark bg-dark navbar-expand-lg">
    
    <a href="/{{ 'dashboard' }}">
        <img src="/images/Xceed_logo_small_01-dark.png" class="img-fluid" width="200px" alt="Responsive image">
    </a>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav  mr-auto d-flex flex-row">
        <li class="nav-item active p-2">
            <a href="/{{ 'dashboard' }}" class="list-group-item list-group-item-action bg-dark border-0 text-white">Dashboard</a>
        </li>
        <li class="nav-item dropdown p-2">
            <a class="nav-link dropdown-toggle bg-dark border-0 text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Quote Dashboard
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/{{ 'quoting' }}">Quote</a>
              @if (Auth::user() && Auth::user()->role == 'admin')
              <a class="dropdown-item" href="/{{ 'perpointquote' }}">Per Point Quote</a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/{{ 'history' }}">History</a>
              <a class="dropdown-item" href="/{{ 'draftlist' }}">Draft</a>
            </div>
          </li>
        <li class="nav-item p-2">
            <a href="/{{ 'pricelist' }}" class="list-group-item list-group-item-action bg-dark border-0 text-white">Price List</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'customers' }}" class="list-group-item list-group-item-action bg-dark border-0 text-white">Customers</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'materials' }}"
                class="list-group-item list-group-item-action border-0 text-white bg-dark border-top">Materials</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'suppliers' }}" class="list-group-item list-group-item-action bg-dark border-0 text-white">Suppliers</a>
        </li>

        @if (Auth::user() && Auth::user()->role == 'admin')
        <li class="nav-item dropdown p-2">
        <a class="nav-link dropdown-toggle bg-dark border-0 text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admin Options
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/{{ 'totalcosts' }}">Total Costs</a>
              <a class="dropdown-item" href="/{{ 'employeecosts' }}">Employee Costs</a>
              <a class="dropdown-item" href="/{{ 'companycosts' }}">Company Cost</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/{{ 'discounts' }}">Discounts</a>
              <a class="dropdown-item" href="/{{ 'users' }}">User Management</a>
              <a class="dropdown-item" href="/{{ 'grossmargin' }}">Quote Management</a>
              <a class="dropdown-item" href="/{{ 'businessdetails' }}">Business Details</a>
              </div>
        </li>
        @endif
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 float-right">
            <li class="nav-item active">
                <a class="nav-link text-white">{{ Auth::user()->user_name }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><svg width="1.25em" height="1.25em" viewBox="0 0 16 16"
                        class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z" />
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd"
                            d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/main/logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
  </nav>

@endif
