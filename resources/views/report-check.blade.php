@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @isset($report)
        <div class="col-12">
            <h3> Проверка отчёта</h3>
            <dl class="row">
                <dt class="col-sm-3">Тип работы</dt>
                <dd class="col-sm-9">{{$report->TW}}</dd>
                <dt class="col-sm-3">Дата выполнения работы</dt>
                <dd class="col-sm-9">{{date('d.m.Y', strtotime($report->date_executed))}}</dd>
                <dt class="col-sm-3">Номер заявки</dt>
                <dd class="col-sm-9">{{$report->number_ticket}}</dd>
                <dt class="col-sm-3">Номер устройства</dt>
                <dd class="col-sm-9">{{$report->number_device}}</dd>
                <dt class="col-sm-3">Пробег</dt>
                <dd class="col-sm-9">{{$report->mileage}}</dd>
                <dt class="col-sm-3">Комментарий</dt>
                <dd class="col-sm-9">{{$report->comment}}</dd>
            </dl>
            <p>Отчёт сдал: <b><i>{{$report->user->position->title}}</i> {{$report->user->family}} {{$report->user->name}} {{$report->user->ibn}}</b></p>
            <form class="mt-2" method="POST" action="{{route('savecheckreport', $report->id)}}">@csrf
                <div class="mb-3 form-floating">
                    <input type="text" maxlength="255" class="form-control" id="reason" name="reason" value="{{ $report->reason }}">
                    <label for="reason" class="form-label">Причина (при необходимости)</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="form-select" name="status" id="status" required>
                        <option  @if($report->status == 2) selected @endif value="2">Прянять</option>
                        <option @if($report->status == 3) selected @endif value="3">Отклонить</option>
                    </select>
                    <label for="status" class="form-label">Решение</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @endisset
    </div>
</div>
@endsection