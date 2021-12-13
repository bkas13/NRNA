@if(is_admin())
    @include('admin.layouts.sidebar')
@elseif(is_regional())
    @include('region.layouts.sidebar')
@elseif(is_individual())
    @include('individual.layouts.sidebar')
@endif
