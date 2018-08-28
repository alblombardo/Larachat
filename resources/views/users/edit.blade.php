@extends('layouts.adminlte.template',['page_title' => 'Account utente'])

@push('styles')

@endpush
@section('content')
    <div class="row">
        {!! Form::model($account, ['method' => 'patch', 'route' => ['users::update',$account->id],'class' => 'form-horizontal']) !!}
        @component('components.widget',['title' => 'Modifica account'])
            @slot('body')
                <div class="form-group required">
                    <label for="" class="col-lg-3 control-label">Nome</label>
                    <div class="col-lg-9">
                        {!! Form::text('name',null, [ 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group required">
                    <label for="" class="col-lg-3 control-label">Cognome</label>
                    <div class="col-lg-9">
                        {!! Form::text('surname', null, [ 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="form-group required">
                    <label for="" class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-9">
                        {!! Form::email('email',null, [ 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                @can('manage_users_roles')
                    <div class="form-group">
                        <label for="" class="col-lg-3 control-label">Ruoli</label>
                        <div class="col-lg-9">
                            {!! Form::select('roles[]', $roles, optional($account->roles)->pluck('id') , [ 'class' => 'form-control mdl-multiselect','multiple']) !!}
                        </div>
                    </div>
                @endcan
                @cannot('manage_users_roles')
                    <div class="form-group">
                        <label for="" class="col-lg-3 control-label">Ruoli</label>
                        <div class="col-lg-9">
                            <p class="form-control">@foreach($account->roles as $role) {{ $role->name }}@if($loop->count > 1 && !$loop->last), @endif @endforeach</p>
                        </div>
                    </div>
                @endcannot
                <div class="form-group">
                    <label for="" class="col-lg-3 control-label">Password</label>
                    <div class="col-lg-9">
                        {!! Form::password('password', [ 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-3 control-label">Verifica Password</label>
                    <div class="col-lg-9">
                        {!! Form::password('password_check', [ 'class' => 'form-control']) !!}
                    </div>
                </div>
            @endslot
            @slot('footer')
                <div class="btn-toolbar">
                    {!! Form::submit('Salva', ['class' => 'btn btn-flat btn-md btn-primary pull-right control-btn']) !!}
                    <a href="@can('list_users'){{ route('users::index') }}@endcan @cannot('list_users'){{ route('admin::dashboard') }}@endcannot"
                       class="btn btn-md btn-flat btn-warning pull-right contrl-btn">Indietro</a>
                    @can('delete',$account)<a href="{{ route('users::delete',$account->id) }}"
                                              class="btn btn-md btn-flat btn-danger pull-right contrl-btn"
                                              data-toggle="modal"
                                              data-target="#myModal">Elimina</a>@endcan
                </div>
            @endslot
        @endcomponent

        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')

@endpush