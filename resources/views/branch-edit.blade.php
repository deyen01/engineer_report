@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($branch) <h3>Редактирование филиала</h3> @else <h3>Добавление филиала</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($branch){{route('savebranch', $branch->id)}}@else{{route('savebranch')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="128" class="form-control" id="title" name="title" required @isset($branch) value="{{ $branch->title }}" @endisset>
                    <label for="title" class="form-label">Наименование</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="15" class="form-control" id="ogrn" name="ogrn" @isset($branch) value="{{ $branch->ogrn }}" @endisset>
                    <label for="ogrn" class="form-label">ОГРН</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="inn" name="inn" @isset($branch) value="{{ $branch->inn }}" @endisset>
                    <label for="inn" class="form-label">ИНН</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="9" class="form-control" id="kpp" name="kpp" @isset($branch) value="{{ $branch->kpp }}" @endisset>
                    <label for="kpp" class="form-label">КПП</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="address" name="address" @isset($branch) value="{{ $branch->address }}" @endisset>
                    <label for="address" class="form-label">Адрес</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" maxlength="255" class="form-control" id="email" name="email" @isset($branch) value="{{ $branch->email }}" @endisset>
                    <label for="email" class="form-label">E-mail</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="12" class="form-control" id="tel" name="tel" @isset($branch) value="{{ $branch->tel }}" @endisset>
                    <label for="tel" class="form-label">Телефон</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @isset($branch)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{ route('deletebranch', $branch->id) }}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection
