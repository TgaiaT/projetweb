<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Formulaire de création de produit</h2>

            {!!Form::open(['url' => 'product/create', "files" => true])!!}

            <div class="form-group {!! $errors->has('product_name') ? 'has-error' : '' !!} row">
                {!!Form::label('product_name', "Nom du produit", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('product_name', null, ['class' => 'form-control', 'placeholder' => "Nom"])!!}
                    {!! $errors->first('product_name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('product_description') ? 'has-error' : '' !!} row">
                {!!Form::label('product_description', "Description du produit", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::textarea('product_description', null, ['class' => 'form-control', 'placeholder' => "Description"])!!}
                    {!! $errors->first('product_description', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('product_price') ? 'has-error' : '' !!} row">
                {!!Form::label('product_price', "Prix du produit", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Prix'])!!}
                    {!! $errors->first('product_price', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('picture_url') ? 'has-error' : '' !!} row">
                {!!Form::label('picture_url', "Image du produit", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::file('picture_url', null, ['class' => 'form-control', 'placeholder' => 'Image'])!!}
                    {!! $errors->first('picture_url', '<small class="help-block">:message</small>') !!}
                </div>
            </div>


            <div class="form-group row text-right">
                <div class="col">
                    {!!Form::submit("Ajouter le produit", ['class' => 'btn btn-primary'])!!}
                </div>
            </div>

            {!!Form::close()!!}

        </div>
    </div>
</div>
