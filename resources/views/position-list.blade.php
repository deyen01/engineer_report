@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{ route('editposition') }}"'>Добавить должность</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('positionsxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Наименование должности</th></tr><thead>
            <tbody>
            @foreach ($positions as $position)
                <tr><td>{{ $position->id }}</td><td><a href="{{ route('editposition', $position->id) }}">{{ $position->title }}</a></td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $positions->links() }}
        @if (count($positions) < 1) Нет должностей. @endif
        </div>
    </div>
</div>
@endsection
