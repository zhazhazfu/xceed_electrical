@extends('layouts.app')

@section('title', 'Categories')

@section('content')
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
<div class="p-3 rounded border">
    <div class="row">
        <div class="col-sm">
            <h3>Edit Sub-Category</h3>
            <form method="post" action="{{action('SubCategoryController@update', $pk_subcategory_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Sub-Category Name</label>
                        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                            value="{{$subCategories->subcategory_name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Parent category</label>
                        <select id="categorySelect" name="fk_category_id" class="form-control">
                            @foreach($categories as $category)
                            @if($category->pk_category_id == $subCategories->fk_category_id)
                            <option value="{{ $category->pk_category_id }}" selected>{{ $category->category_name }}
                            </option>
                            @else
                            <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="subcategory_archived" name="subcategory_archived" class="form-control">
                            @if ($subCategories->subcategory_archived == 0)
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                            @else
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{url('/categories')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
