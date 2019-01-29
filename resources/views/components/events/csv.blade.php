{{-- get the registered users of an event in CSV file --}}
<div class="mx-auto my-2 mx-auto">
    {!!Form::open(['url' => 'event/csv', "target" => "_blank"])!!}
        <a href="/event/csv" target="_blank">
            <input type="hidden" name="activity" value="{{json_encode($activity)}}" class="d-none">
            <button type="submit" class="btn btn-outline-primary">Récupérer les inscrits</button>
        </a>
    {!!Form::close()!!}
</div>
