@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{route('editreport')}}"'>Создать отчёт</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('reportsxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Тип работы</th><th>Дата выполнения работы</th><th>Номер заявки</th><th>Локация</th><th>Адрес</th><th>Номер устройства</th><th>Пробег</th><th>Клиент</th><th>Комментарий</th><th>Автор</th><th>Модератор</th></tr><thead>
            <tbody>
            @foreach ($reports as $report)
                <tr @if(Auth::user()->access_level > 0) onclick='location.href="{{route('checkreport', $report->id)}}"' @endif class="@switch($report->status)@case(0)table-secondary @break @case(1)table-primary @break @case(2)table-success @break @case(3)table-danger @break @default @endswitch"><td>{{ $report->id }}</td><td>{{ $report->TW }}</td><td>@if(Auth::id() == $report->user_id)<a href="{{route('editreport', $report->id)}}">{{date('d.m.Y', strtotime($report->date_executed))}}</a>@else{{date('d.m.Y', strtotime($report->date_executed))}}@endif</td><td>{{ $report->number_ticket }}</td><td>{{ $report->location }}</td><td>{{ $report->address }}</td><td>{{ $report->number_device }}</td><td>{{ $report->mileage }}</td><td>{{ $report->title_client }}</td><td>{{ $report->comment }}</td><td>{{$report->user->family}} {{$report->user->name}}</td><td>@if($report->moderator){{$report->moderator->family}} {{$report->moderator->name}}@endif</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $reports->links() }}
        @if (count($reports) < 1) Нет отчётов. @endif
        </div>
    </div>
</div>
@endsection