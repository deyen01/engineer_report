@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($position) <h3>Редактирование должности</h3> @else <h3>Добавление должности</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($position){{route('saveposition', $position->id)}}@else{{route('saveposition')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="64" class="form-control" id="title" name="title" required @isset($position) value="{{ $position->title }}" @endisset>
                    <label for="title" class="form-label">Наименование</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @isset($position)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{ route('deleteposition', $position->id) }}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection
