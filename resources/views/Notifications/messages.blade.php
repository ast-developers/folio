@if(Session::has('message'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert {{ Session::get('alert-class', 'alert alert-info') }} msg">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif