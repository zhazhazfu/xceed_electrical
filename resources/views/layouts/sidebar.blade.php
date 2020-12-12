@if (Auth::user())
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">
    
        <img src="/images/Xceed_logo_small_01-copy1.png" class="img-fluid" width="200px" alt="Responsive image">
    </div>
    <div class="list-group list-group-flush">
        <a href="/{{ 'dashboard' }}" class="list-group-item list-group-item-action bg-light  border-0">Dashboard</a>
        <a href="#quotesSubmenu" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action bg-light dropdown-toggle dropdown-menu border-bottom-0">Quotes</a>
        <ul class="collapse list-unstyled border-0 small" id="quotesSubmenu">
            <li>
                <a href="/{{ 'quoting' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0">Create
                    Quote</a>
            </li>
            <li>
                <a href="/{{ 'quoteterms' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0">Quote Terms</a>
            </li>
        </ul>

        <a href="#pricelistSubmenu" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action bg-light dropdown-toggle dropdown-menu border-bottom-0">Price
            Lists</a>
        <ul class="collapse list-unstyled border-0 small" id="pricelistSubmenu">
            <li>
                <a href="/categories"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Category
                    Management</a>
            </li>
            <!-- CATEGORY FOR LOOP GOES HERE -->
            <li>
                <x-sidebarCategories />
            </li>
        </ul>
        <a href="/{{ 'customers' }}" class="list-group-item list-group-item-action bg-light border-0">Customers</a>
        <a href="/{{ 'materials' }}"
            class="list-group-item list-group-item-action bg-light border-0 border-top">Materials</a>
        <a href="/{{ 'suppliers' }}" class="list-group-item list-group-item-action bg-light border-0">Suppliers</a>
        @if (Auth::user() && Auth::user()->role == 'admin')
        <h5 href="#"
            class="border-top mt-2 list-group-item list-group-item-action bg-light border-right-0 border-left-0 border-bottom-0">
            Admin Options</h5>

        <a href="#costsSubmenu" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action bg-light dropdown-toggle dropdown-menu border-bottom-0">Costs
            & Expenses</a>
        <ul class="collapse list-unstyled border-0 small" id="costsSubmenu">
            <li>
                <a href="/{{ 'grossmargin' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Gross
                    Margin</a>
            </li>
            <li>
                <a href="/{{ 'totalcosts' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Total
                    Business & Employee Costs</a>
            </li>
            <li>
                <a href="/{{ 'employeecosts' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Employee
                    Costs</a>
            </li>
            <li>
                <a href="/{{ 'companycosts' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Company
                    Costs</a>
            </li>
            <li>
                <a href="/{{ 'discounts' }}"
                    class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4">Discounts</a>
            </li>
        </ul>
        <a href="/{{ 'users' }}" class="list-group-item list-group-item-action bg-light border-0">User Management</a>
        <a href="/{{ 'businessdetails' }}" class="list-group-item list-group-item-action bg-light border-0">Business
            Details</a>
        @endif

    </div>
</div>
@endif
