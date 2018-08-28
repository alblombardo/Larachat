@extends('layouts.adminlte.template',['page_title' => 'Account utente'])

@push('styles')

@endpush
@section('content')
    <div class="row">
        @component('components.widget')
            @slot('title')
                Crea nuovo account
            @endslot
            @slot('body')
                {!! Form::open(['route' => 'users::store','class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Nome</label>
                    <div class="col-lg-10">
                        {!! Form::text('name', null, [ 'class' => 'form-control','style' => 'width: 100%']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Cognome</label>
                    <div class="col-lg-10">
                        {!! Form::text('surname', null, [ 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        {!! Form::email('email', null, [ 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group required">
                        <label for="" class="col-lg-2 control-label">Ruoli</label>
                        <div class="col-lg-10">
                            {!! Form::select('roles[]', $roles, [3] , [ 'class' => 'form-control mdl-multiselect','multiple','required']) !!}
                        </div>

                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        {!! Form::password('password', [ 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Verifica Password</label>
                    <div class="col-lg-10">
                        {!! Form::password('password_check', [ 'class' => 'form-control']) !!}
                    </div>
                </div>
            @endslot
            @slot('footer')
                <div class="btn-toolbar">
                    {!! Form::submit('Salva', ['class' => 'btn btn-flat btn-md btn-primary pull-right control-btn']) !!}
                    <a href="{{ route('users::index') }}"
                       class="btn btn-flat btn-md btn-warning pull-right contrl-btn">Indietro</a>
                </div>
            @endslot
            {!! Form::close() !!}

        @endcomponent

        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')

@endpush