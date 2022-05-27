<table>
    <thead><tr><th>ID</th><th>Тип работы</th><th>Дата выполнения работы</th><th>Номер заявки</th><th>Локация</th><th>Адрес</th><th>Номер устройства</th><th>Пробег</th><th>Клиент</th><th>Комментарий</th><th>Автор</th><th>Модератор</th><th>Статус</th><th>Причина</th></tr><thead>
    <tbody>
    @foreach ($reports as $report)
        <tr><td>{{$report->id}}</td><td>{{$report->TW}}</td><td>{{date('d.m.Y', strtotime($report->date_executed))}}</td><td>{{$report->number_ticket}}</td><td>{{$report->location}}</td><td>{{$report->address}}</td><td>{{$report->number_device}}</td><td>{{$report->mileage}}</td><td>{{$report->title_client}}</td><td>{{$report->comment}}</td><td>{{$report->user->family}} {{$report->user->name}}</td><td>@if($report->moderator){{$report->moderator->family}} {{$report->moderator->name}}@endif</td><td>{{$report->ST}}</td><td>{{$report->reason}}</td></tr>
    @endforeach
    </tbody>
</table>