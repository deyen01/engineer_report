@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{route('edituser')}}"'>Добавить пользователя</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('usersxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>E-mail</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>ИНН</th><th>Должность</th><th>Телефон</th><th>Локация</th><th>Адрес</th><th>Филиал</th><th>Уровень доступа</th><th>Включён?</th><th>Создан</th><th>Изменён</th></tr><thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('edituser', $user->id)}}">{{$user->email}}</a></td>
                <td>{{$user->family}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->ibn}}</td>
                <td>{{$user->inn}}</td>
                <td>@isset($user->position){{$user->position->title}}@endisset</td>
                <td>{{$user->tel}}</td>
                <td>@isset($user->location){{$user->location->title}}@endisset</td>
                <td>{{$user->address}}</td>
                <td>@isset($user->branch){{$user->branch->title}}@endisset</td>
                <td>{{$user->AL}}</td>
                <td>{{$user->Enable}}</td>
                <td>{{date('d.m.Y H:i:s', strtotime($user->created_at))}}</td>
                <td>{{date('d.m.Y H:i:s', strtotime($user->updated_at))}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        @if (count($users) < 1) Нет пользователей. @endif
        </div>
    </div>
</div>
@endsection
