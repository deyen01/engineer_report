@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{ route('editlocation') }}"'>Добавить локацию(город, район)</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('locationsxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Наименование</th><th>ОКТМО</th></tr><thead>
            <tbody>
            @foreach ($locations as $location)
                <tr><td>{{ $location->id }}</td><td><a href="{{ route('editlocation', $location->id) }}">{{ $location->title }}</a></td><td>{{ $location->oktmo }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $locations->links() }}
        @if (count($locations) < 1) Нет локаций. @endif
        </div>
    </div>
</div>
@endsection