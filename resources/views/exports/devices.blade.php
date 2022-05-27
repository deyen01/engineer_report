<table>
    <thead><tr><th>ID</th><th>Номер устройства</th><th>Локация</th><th>Адрес</th><th>Место установки</th><th>Модель устройства</th><th>Клиент</th><th>Добавил</th></tr><thead>
    <tbody>
    @foreach ($devices as $device)
        <tr><td>{{ $device->id }}</td><td>{{ $device->number }}</td><td>@if($device->location){{$device->location->title}}@endif</td><td>{{ $device->address }}</td><td>{{ $device->place }}</td><td>{{ $device->vendor }}</td><td>@if($device->client){{ $device->client->title }}@endif</td><td>{{ $device->user->family }} {{ $device->user->name }}</td></tr>
    @endforeach
    </tbody>
</table>