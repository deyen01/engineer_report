@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($user) <h3>Редактирование пользователя</h3> @else <h3>Добавление пользователя</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($user){{route('saveuser', $user->id)}}@else{{route('saveuser')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="email" maxlength="250" class="form-control" id="email" name="email" required @isset($user) value="{{ $user->email }}" @endisset>
                    <label for="email" class="form-label">E-mail</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="family" name="family" @isset($user) value="{{ $user->family }}" @endisset>
                    <label for="family" class="form-label">Фамилия</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="name" name="name" @isset($user) value="{{ $user->name }}" @endisset>
                    <label for="name" class="form-label">Имя</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="ibn" name="ibn" @isset($user) value="{{ $user->ibn }}" @endisset>
                    <label for="ibn" class="form-label">Отчество</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="inn" name="inn" @isset($user) value="{{ $user->inn }}" @endisset>
                    <label for="inn" class="form-label">ИНН</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="position_id" id="position_id">
                    @foreach($positions as $position)
                        <option @isset($user) @if($user->position_id == $position->id) selected @endif @endisset value="{{ $position->id }}">{{ $position->title }}</option>
                    @endforeach
                    </select>
                    <label for="position_id" class="form-label">Должность</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="tel" name="tel" @isset($user) value="{{ $user->tel }}" @endisset>
                    <label for="tel" class="form-label">Телефон</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="location_id" id="location_id">
                    @foreach($locations as $location)
                        <option @isset($user) @if($user->location_id == $location->id) selected @endif @endisset value="{{ $location->id }}">{{ $location->title }}</option>
                    @endforeach
                    </select>
                    <label for="location_id" class="form-label">Локация (город, район)</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="address" name="address" @isset($user) value="{{ $user->address }}" @endisset>
                    <label for="address" class="form-label">Адрес</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="branch_id" id="branch_id">
                    @foreach($branches as $branch)
                        <option @isset($user) @if($user->branch_id == $branch->id) selected @endif @endisset value="{{ $branch->id }}">{{ $branch->title }}</option>
                    @endforeach
                    </select>
                    <label for="branch_id" class="form-label">Филиал</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="access_level" id="access_level">
                        <option @isset($user) @if($user->access_level == 0) selected @endif @endisset value="0">Обычный</option>
                        <option @isset($user) @if($user->access_level == 1) selected @endif @endisset value="1">Модератор</option>
                        <option @isset($user) @if($user->access_level == 2) selected @endif @endisset value="2">Администратор</option>
                    </select>
                    <label for="access_level" class="form-label">Уровень доступа</label>
                </div>
                @empty($user)
                <div class="mb-3">
                    <p>Новый пароль <b>{{$newpass}}</b></p>
                </div>
                @endempty
                <div class="mb-3 form-floating">
                    <select class="form-select" name="enabled" id="enabled" required>
                        <option @isset($user) @if($user->enabled) selected @endif @endisset value="1">Да</option>
                        <option @isset($user) @unless($user->enabled) selected @endunless @endisset value="0">Нет</option>
                    </select>
                    <label for="enabled" class="form-label">Включён?</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                @isset($user)<button type="button" class="btn btn-warning" onclick='location.href="{{route('updatepwduser', $user->id)}}"'>Обновить пароль</button>@endisset
            </form>
        </div>
        @isset($user) @if ($user->id != Auth::id())
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{route('deleteuser', $user->id)}}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endif @endisset
    </div>
</div>
@endsection
