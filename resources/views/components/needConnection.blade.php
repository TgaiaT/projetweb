@if(session()->get("isConnected"))
    @yield("ifConnected")
@else
    @section('ifNotConnected')
        @include('components.connection.mustBeConnected')
    @show
@endif
