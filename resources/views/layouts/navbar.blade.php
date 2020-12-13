@if (Auth::user())
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/{{ 'dashboard' }}">
    <img src="/images/Xceed_logo_small_01-copy1.png" class="img-fluid" width="200px" alt="Responsive image">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto d-flex flex-row">
        <li class="nav-item active p-2 ">
            <a href="/{{ 'dashboard' }}" class="list-group-item list-group-item-action bg-light  border-0">Dashboard</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'qdash' }}" class="list-group-item list-group-item-action bg-light border-0">Quote Dashboard</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'pricelist' }}" class="list-group-item list-group-item-action bg-light border-0">Price list</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'customers' }}" class="list-group-item list-group-item-action bg-light border-0">Customers</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'materials' }}"
                class="list-group-item list-group-item-action bg-light border-0 border-top">Materials</a>
        </li>
        <li class="nav-item p-2">
            <a href="/{{ 'suppliers' }}" class="list-group-item list-group-item-action bg-light border-0">Suppliers</a>
        </li>

        @if (Auth::user() && Auth::user()->role == 'admin')
        <li class="nav-item p-2">
            <a href="/{{ 'admindash' }}" class="list-group-item list-group-item-action bg-light border-0">Admin Options</a>
        </li>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              costs & Expenses
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="/{{ 'grossmargin' }}" 
                  class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Gross
                      Margin</a>
              
                  <a href="/{{ 'totalcosts' }}"
                      class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Total
                      Business & Employee Costs</a>
              
                  <a href="/{{ 'employeecosts' }}"
                      class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Employee
                      Costs</a>
              
                  <a href="/{{ 'companycosts' }}"
                      class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Company
                      Costs</a>
              
                  <a href="/{{ 'discounts' }}"
                      class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Discounts</a>
            </div>
        </li> --}}
        @endif
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 float-right">
            <li class="nav-item active">
                <a class="nav-link">{{ Auth::user()->user_name }}<span class="sr-only">(current)</span></a>
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
