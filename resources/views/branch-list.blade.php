@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 bg-white rounded-3">
        <button type="button" class="btn btn-outline-primary mt-4" onclick='location.href="{{ route('editbranch') }}"'>Добавить филиал</button>
        <a type="button" class="btn btn-outline-success mt-4" target="_blank" href="{{route('branchesxlsx')}}" role="button">Скачать в .xlsx</a>
        <table class="table table-striped table-hover">
            <thead><tr><th>ID</th><th>Наименование</th><th>ОГРН</th><th>ИНН</th><th>КПП</th><th>Адрес</th><th>E-mail</th><th>Телефон</th></tr><thead>
            <tbody>
            @foreach ($branches as $branch)
                <tr><td>{{ $branch->id }}</td><td><a href="{{ route('editbranch', $branch->id) }}">{{ $branch->title }}</a></td><td>{{ $branch->ogrn }}</td><td>{{ $branch->inn }}</td><td>{{ $branch->kpp }}</td><td>{{ $branch->address }}</td><td>{{ $branch->email }}</td><td>{{ $branch->tel }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $branches->links() }}
        @if (count($branches) < 1) Нет филиалов. @endif
        </div>
    </div>
</div>
@endsection
