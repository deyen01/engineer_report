<table>
    <thead><tr><th>ID</th><th>E-mail</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>ИНН</th><th>Должность</th><th>Телефон</th><th>Локация</th><th>Адрес</th><th>Филиал</th><th>Уровень доступа</th><th>Включён?</th><th>Создан</th><th>Изменён</th></tr><thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->family}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->ibn}}</td>
        <td>{{$user->inn}}</td>
        <td>@isset($user->position){{$user->position->title}}@endisset</td>
        <td>{{$user->tel}}</td>
        <td>@isset($user->location){{$user->location->title}}@endisset</td>
        <td>{{$user->address}}</td>
        <td>@isset($user->branch){{$user->branch->title}}@endisset</td>
        <td>{{$user->AL}}</td>
        <td>{{$user->Enable}}</td>
        <td>{{date('d.m.Y H:i:s', strtotime($user->created_at))}}</td>
        <td>{{date('d.m.Y H:i:s', strtotime($user->updated_at))}}</td>
    </tr>
    @endforeach
    </tbody>
</table>