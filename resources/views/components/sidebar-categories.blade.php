
@foreach($categories as $category)
    @if($category->category_archived == '0')
    <a href="{{action('PriceListController@show', $category['pk_category_id'])}}" class="p-4 m-2 btn btn-outline-xceed"
    id="categories" value="{{ $category->pk_category_id }}"> <div class='tint'></div> 
    <svg> 
        <path d="{{ $category->category_icon }}" fill="#004271"/>
    </svg>
    <h3 class="float-right"> {{ $category->category_name }} </h3></a>
    @endif
@endforeach
