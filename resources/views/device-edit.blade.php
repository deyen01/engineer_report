@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @isset($device) <h3>Редактирование устройства</h3> @else <h3>Добавление устройства</h3> @endisset
            <form class="mt-2" method="POST" action="@isset($device){{route('savedevice', $device->id)}}@else{{route('savedevice')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="64" class="form-control" id="number" name="number" required @isset($device) value="{{ $device->number }}" @endisset>
                    <label for="number" class="form-label">Номер устройства</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="location_id" id="location_id">
                    @foreach($locations as $location)
                        <option @isset($device) @if($device->location_id == $location->id) selected @endif @endisset value="{{ $location->id }}">{{ $location->title }}</option>
                    @endforeach
                    </select>
                    <label for="location_id" class="form-label">Локация (город, район)</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="address" name="address" @isset($device) value="{{ $device->address }}" @endisset>
                    <label for="address" class="form-label">Адрес</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="place" name="place" @isset($device) value="{{ $device->place }}" @endisset>
                    <label for="place" class="form-label">Место установки</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="vendor" name="vendor" @isset($device) value="{{ $device->vendor }}" @endisset>
                    <label for="vendor" class="form-label">Модель (vendor)</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="client_id" id="client_id">
                    @foreach($clients as $client)
                        <option @isset($device) @if($device->client_id == $client->id) selected @endif @endisset value="{{ $client->id }}">{{ $client->title }}</option>
                    @endforeach
                    </select>
                    <label for="client_id" class="form-label">Клиент</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @isset($device)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{ route('deletedevice', $device->id) }}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection