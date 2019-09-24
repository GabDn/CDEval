@if (Session::has('update'))
    <div class="alert alert-success" role=alert>
        <strong> {{Session::get('update')}}</strong>
    </div>
@endif

@if (Session::has('delete'))
    <div class="alert alert-success" role=alert>
        <strong> {{Session::get('delete')}}</strong>
    </div>
@endif

@if (Session::has('create'))
    <div class="alert alert-success" role=alert>
        <strong> {{Session::get('create')}}</strong>
    </div>
@endif

@if (Session::has('error_salon'))
    <div class="alert alert-danger" role=alert>
        <strong> {{Session::get('error_salon')}}</strong>
    </div>
@endif

@if (Session::has('error_carrera'))
    <div class="alert alert-danger" role=alert>
        <strong> {{Session::get('error_carrera')}}</strong>
    </div>
@endif

@if (Session::has('inscripcion'))
    <div class="alert alert-success" role=alert>
        <strong> {{Session::get('inscripcion')}}</strong>
    </div>
@endif

@if (Session::has('verRespuesta'))
    <div class="alert alert-success" role=alert>
        <strong> {{Session::get('verRespuesta')}}</strong>
    </div>
@endif