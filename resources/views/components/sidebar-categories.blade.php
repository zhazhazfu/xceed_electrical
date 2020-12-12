
@foreach($categories as $category)
    @if($category->category_archived == '0')
    <a href="{{action('PriceListController@show', $category['pk_category_id'])}}" class="dropdown-item list-group-item list-group-item-action bg-light border-0 pl-4" value="{{ $category->pk_category_id }}">{{ $category->category_name }}</a>
    @endif
@endforeach
