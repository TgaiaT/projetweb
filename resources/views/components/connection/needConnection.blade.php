{{-- Component isn't used anymore --}}
@if(session()->get("isConnected"))
    @yield("ifConnected")
@else
    @section('ifNotConnected')
        @include('components.connection.mustBeConnected')
    @show
@endif
