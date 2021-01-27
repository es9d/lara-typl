<form action="{{ route("job.search") }}" class="form " method="get">
    <div class="g-field-search">
        <input type="text" 
            @if( !empty(Request::query('s')) ) 
                value="{{ Request::query('s') }}"
            @endif
        class="form-control" name="s" style="border-radius: 50px;padding:2.0rem 160px 2.0rem 3.5rem;">
        <button class="btn btn-primary btn-search" type="submit" style="border-radius: 44px;width: 150px;top: calc(2px - 4rem);position: relative;left: calc( 100% - 13rem);height: 3.5rem;">{{__("Search")}}</button>
    </div>
</form>