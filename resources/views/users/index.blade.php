@extends('layouts.adminlte.template',['page_title' => 'Account'])

@section('content')
    <div class="row">
        @component('components.widget',['title' => 'Elenco'])
            @slot('body')
                @component('components.table-list')
                    @slot('head')
                        <tr>
                            <td class="btn-toolbar">@can('create_users')<a href="{{ route('users::create') }}"
                                                       class="btn btn-sm btn-success btn-flat glyphicon glyphicon-plus"></a>@endcan
                            </td>
                            <td>Nominativo</td>
                            <td>Email</td>
                        </tr>
                    @endslot
                    @slot('body')
                        @forelse($accounts as $account)
                            <tr>
                                <td class="btn-toolbar">
                                    @can('update_users',$account)<a
                                            href="{{ route('users::edit', $account->id) }}"
                                            class="btn btn-sm btn-primary btn-flat glyphicon glyphicon-edit"></a>
                                    @endcan
                                    @can('delete_users',$account)<a
                                            href="{{ route('users::delete', $account->id) }}"
                                            class="btn btn-sm btn-danger btn-flat glyphicon glyphicon-remove"
                                            data-toggle="modal" data-target="#myModal"></a>
                                    @endcan
                                </td>
                                <td>{{ $account->fullName }}</td>
                                <td>{{ $account->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Nessun record disponibile</td>
                            </tr>
                        @endforelse
                    @endslot
                    @slot('footer')
                    @endslot
                @endcomponent
            @endslot
        @endcomponent
    </div>

@endsection