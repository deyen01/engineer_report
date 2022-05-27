@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($location) <h3>Редактирование локации</h3> @else <h3>Добавление локации</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($location){{route('savelocation', $location->id)}}@else{{route('savelocation')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="64" class="form-control" id="title" name="title" required @isset($location) value="{{ $location->title }}" @endisset>
                    <label for="title" class="form-label">Наименование</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="11" class="form-control" id="oktmo" name="oktmo" @isset($location) value="{{ $location->oktmo }}" @endisset>
                    <label for="oktmo" class="form-label">ОКТМО</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @isset($location)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{ route('deletelocation', $location->id) }}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection