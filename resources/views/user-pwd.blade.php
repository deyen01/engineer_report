@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @isset($user)
        <div class="col-12">
            <h3>Обновление пароля пользователя</h3>
            <form class="mt-2" method="POST" action="{{route('savepwduser', $user->id)}}">@csrf
                <div class="mb-3">
                    <p>Новый пароль <b>{{$newpass}}</b></p>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        @endisset
    </div>
</div>
@endsection