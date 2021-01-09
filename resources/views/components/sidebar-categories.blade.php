
@foreach($categories as $category)
    @if($category->category_archived == '0')
    <a href="{{action('PriceListController@show', $category['pk_category_id'])}}" class="p-4 m-2 btn btn-outline-xceed"
        id="categories" value="{{ $category->pk_category_id }}">
            <svg
            height="100px"
            viewBox="0 0 65 65"
            version="1.1"
            class=" h-auto w-auto float-left">
                <g>
                    <path
                    d="{{ $category->category_icon }}" fill="#004271"/>
                </g>
            </svg>
        <h3 class="float-right"> {{ $category->category_name }} </h3>
    </a>
    @endif
@endforeach
