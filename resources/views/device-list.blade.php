@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{route('editdevice')}}"'>Добавить устройство</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('devicesxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Номер устройства</th><th>Локация</th><th>Адрес</th><th>Место установки</th><th>Модель устройства</th><th>Клиент</th><th>Добавил</th></tr><thead>
            <tbody>
            @foreach ($devices as $device)
                <tr><td>{{ $device->id }}</td><td><a href="{{route('editdevice', $device->id)}}">{{ $device->number }}</a></td><td>@if($device->location){{$device->location->title}}@endif</td><td>{{ $device->address }}</td><td>{{ $device->place }}</td><td>{{ $device->vendor }}</td><td>@if($device->client){{ $device->client->title }}@endif</td><td>{{ $device->user->family }} {{ $device->user->name }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $devices->links() }}
        @if (count($devices) < 1) Нет устройств. @endif
        </div>
    </div>
</div>
@endsection