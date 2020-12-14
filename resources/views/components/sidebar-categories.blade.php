
@foreach($categories as $category)
    @if($category->category_archived == '0')
    <a href="{{action('PriceListController@show', $category['pk_category_id'])}}" class="p-5 m-1 btn btn-outline-primary" id="categories" value="{{ $category->pk_category_id }}"> <h3 class="float-right"> {{ $category->category_name }} </h3></a>
    @endif
@endforeach
