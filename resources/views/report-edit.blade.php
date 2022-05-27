@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3>@isset($report)Редактирование@else Добавление@endisset отчёта</h3>
            @isset($report) @switch($report->status)
                @case(0)
                    <div class="alert alert-secondary" role="alert"><b>Черновик.</b> {{$report->reason}}</div>
                    @break
                @case(1)
                    <div class="alert alert-primary" role="alert"><b>Подан на проверку.</b> {{$report->reason}}</div>
                    @break
                @case(2)
                    <div class="alert alert-success" role="alert"><b>Принят.</b> {{$report->reason}}</div>
                    @break
                @case(3)
                    <div class="alert alert-danger" role="alert"><b>Отклонён.</b> {{$report->reason}}</div>
                    @break
                @default
            @endswitch
            @endisset
            <form class="mt-2" method="POST" action="@isset($report){{route('savereport', $report->id)}}@else{{route('savereport')}}@endisset">@csrf
                <div class="mb-3 form-floating">
                    <select class="form-select" name="type_of_work" id="type_of_work">
                        <option @isset($report) @if($report->type_of_work == 0) selected @endif @endisset value="0">FLM</option>
                        <option @isset($report) @if($report->type_of_work == 1) selected @endif @endisset value="1">SLM</option>
                        <option @isset($report) @if($report->type_of_work == 2) selected @endif @endisset value="2">Cleaning</option>
                        <option @isset($report) @if($report->type_of_work == 3) selected @endif @endisset value="3">Дежурство</option>
                        <option @isset($report) @if($report->type_of_work == 4) selected @endif @endisset value="4">Возвращение домой</option>
                    </select>
                    <label for="type_of_work" class="form-label">Тип работы</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="date" class="form-control" id="date_executed" name="date_executed" @isset($report) value="{{ $report->date_executed }}" @endisset required>
                    <label for="date_executed" class="form-label">Дата выполнения работы</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="number_ticket" name="number_ticket" @isset($report) value="{{ $report->number_ticket }}" @endisset>
                    <label for="number_ticket" class="form-label">Номер заявки</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="64" class="form-control" id="number_device" name="number_device" @isset($report) value="{{ $report->number_device }}" @endisset>
                    <label for="number_device" class="form-label">Номер устройства</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" min="0" step="1" max="10000000" class="form-control" id="mileage" name="mileage" @isset($report) value="{{ $report->mileage }}" @endisset>
                    <label for="mileage" class="form-label">Пробег</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="comment" name="comment" @isset($report) value="{{ $report->comment }}" @endisset>
                    <label for="comment" class="form-label">Комментарий</label>
                </div>
                <button type="submit" class="btn btn-primary">Подать на проверку</button>
            </form>
        </div>
        @isset($report)
        <div class="col-12">
            <form class="mt-2" method="POST" onsubmit="return confirm('Уверены?');" action="{{route('deletereport', $report->id)}}">@csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            <form>
        </div>
        @endisset
    </div>
</div>
@endsection