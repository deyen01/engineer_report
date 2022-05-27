@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($client) <h3>Редактирование клиента</h3> @else <h3>Добавление клиента</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($client){{route('saveclient', $client->id)}}@else{{route('saveclient')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="128" class="form-control" id="title" name="title" required @isset($client) value="{{ $client->title }}" @endisset>
                    <label for="title" class="form-label">Наименование</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="15" class="form-control" id="ogrn" name="ogrn" @isset($client) value="{{ $client->ogrn }}" @endisset>
                    <label for="ogrn" class="form-label">ОГРН</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="inn" name="inn" @isset($client) value="{{ $client->inn }}" @endisset>
                    <label for="inn" class="form-label">ИНН</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="9" class="form-control" id="kpp" name="kpp" @isset($client) value="{{ $client->kpp }}" @endisset>
                    <label for="kpp" class="form-label">КПП</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="address" name="address" @isset($client) value="{{ $client->address }}" @endisset>
                    <label for="address" class="form-label">Адрес</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" maxlength="255" class="form-control" id="email" name="email" @isset($client) value="{{ $client->email }}" @endisset>
                    <label for="email" class="form-label">E-mail</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="tel" name="tel" @isset($client) value="{{ $client->tel }}" @endisset>
                    <label for="tel" class="form-label">Телефон</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @isset($client)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{ route('deleteclient', $client->id) }}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection