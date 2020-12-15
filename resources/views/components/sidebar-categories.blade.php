
@foreach($categories as $category)
    @if($category->category_archived == '0')
    <a href="{{action('PriceListController@show', $category['pk_category_id'])}}" class="p-5 m-1 btn btn-outline-xceed"
    id="categories" value="{{ $category->pk_category_id }}"> <img src="/images/lighting.png" class="img-fluid float-left" width="40px" alt="Responsive image">
    <h3 class="align-middle float-right w-75"> {{ $category->category_name }} </h3></a>
    @endif
@endforeach
