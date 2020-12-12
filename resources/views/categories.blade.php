@extends('layouts.app')

@section('title', 'Category Management')

@section('content')

<!-- Button trigger modal -->
<div class=" bg-white">
    <div>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
    </div>
</div>

<!-- Add category button -->
<div class=" p-3 mb-5 bg-white rounded border">
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#categoryModal">
        Add Category
    </button>

    <!-- Active/Archived buttons -->
    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Enter category details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('categories') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="category_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Category name</label>
                                <input type="text" class="form-control" id="categoryName" name="category_name"
                                    placeholder="Lighting">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Active category content -->
    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Categories</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search category name">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Category Name</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    @if($category->category_archived == '0')
                    <tr>
                        <td><a href="{{action('PriceListController@show', $category['pk_category_id'])}}">{{ $category->category_name }}</a></td>
                        <td><a href="{{action('CategoryController@edit', $category['pk_category_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived category content -->
    <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived categories</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search category name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Category Name</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    @if($category->category_archived == '1')
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td><a href="{{action('CategoryController@edit', $category['pk_category_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class=" p-3 mb-5 bg-white rounded border">

    <!-- Add subcategory button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#subcategoryModal">
        Add Sub-Category
    </button>

    <!-- Active/Archived subcategory buttons -->
    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active2" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived2" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="subcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryModalLabel">Enter sub-category details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('subcategories') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="subcategory_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Sub-Category name</label>
                                <input type="text" class="form-control" id="subcategoryName" name="subcategory_name"
                                    placeholder="Light Switches">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Parent category</label>
                                <select id="categorySelect" name="fk_category_id" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Sub-Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Active subcategory content -->
    <div id="active_div2">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Sub-categories</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input2" onkeyup="activeFunction2()"
                    placeholder="Search sub-category name">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive2(0)">Sub-Category</th>
                        <th scope="col" onclick="sortActive2(1)">Parent Category</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $subcategory)
                    @if($subcategory->subcategory_archived == '0' && $subcategory->categories->category_archived == '0')
                    <tr>
                        <td>{{ $subcategory->subcategory_name }}</td>
                        <td>{{ $subcategory->categories->category_name }}</td>
                        <td><a
                                href="{{action('SubCategoryController@edit', $subcategory['pk_subcategory_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived subcategories content -->
    <div id="archived_div2" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived sub-categories</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input2" onkeyup="archivedFunction2()"
                    placeholder="Search sub-category name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived2(0)">Sub-Category</th>
                        <th scope="col" onclick="sortArchived2(1)">Parent Category</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $subcategory)
                    @if($subcategory->subcategory_archived == '1' && $subcategory->categories->category_archived != '1')
                    <tr>
                        <td>{{ $subcategory->subcategory_name }}</td>
                        <td>{{ $subcategory->categories->category_name }}</td>
                        <td><a
                                href="{{action('SubCategoryController@edit', $subcategory['pk_subcategory_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop
