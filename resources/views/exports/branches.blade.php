<table>
    <thead><tr><th>ID</th><th>Наименование</th><th>ОГРН</th><th>ИНН</th><th>КПП</th><th>Адрес</th><th>E-mail</th><th>Телефон</th></tr><thead>
    <tbody>
    @foreach ($branches as $branch)
        <tr><td>{{$branch->id}}</td><td>{{$branch->title}}</td><td>{{$branch->ogrn}}</td><td>{{$branch->inn}}</td><td>{{$branch->kpp}}</td><td>{{$branch->address}}</td><td>{{$branch->email}}</td><td>{{$branch->tel}}</td></tr>
    @endforeach
    </tbody>
</table>