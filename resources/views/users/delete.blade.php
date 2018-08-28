@component('components.modal')
    @slot('header_classes')
        bg-danger
    @endslot
    @slot('title')
        Cancella Account
    @endslot
    @slot('content')
        <p>Confermi la cancellazione dell'account?</p>
        {!! Form::open(['route' => ['users::destroy', $account->id], 'method' => 'delete', 'class' => 'form-horizontal', 'style' => 'padding: 15px 15px 0 15px']) !!}
        <div class="form-group">
            <p><b>Nominativo: </b> {{$account->fullName}}</p>
            <p><b>Nominativo: </b> {{$account->email}}</p>
        </div>
        <div class="btn-toolbar">
            <button type="button" class="btn btn-flat btn-sm btn-primary pull-right control-btn" data-dismiss="modal">Annulla</button>
            {!! Form::submit('Elimina', ['class' => 'btn btn-flat btn-sm btn-danger pull-right control-btn']) !!}
        </div>
        {!! Form::close() !!}
    @endslot
@endcomponent
