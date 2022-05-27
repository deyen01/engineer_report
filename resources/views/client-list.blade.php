@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{ route('editclient') }}"'>Добавить клиента</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('clientsxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Наименование</th><th>ОГРН</th><th>ИНН</th><th>КПП</th><th>Адрес</th><th>E-mail</th><th>Телефон</th></tr><thead>
            <tbody>
            @foreach ($clients as $client)
                <tr><td>{{ $client->id }}</td><td><a href="{{ route('editclient', $client->id) }}">{{ $client->title }}</a></td><td>{{ $client->ogrn }}</td><td>{{ $client->inn }}</td><td>{{ $client->kpp }}</td><td>{{ $client->address }}</td><td>{{ $client->email }}</td><td>{{ $client->tel }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $clients->links() }}
        @if (count($clients) < 1) Нет клиентов. @endif
        </div>
    </div>
</div>
@endsection