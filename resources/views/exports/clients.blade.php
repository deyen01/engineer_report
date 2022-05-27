<table>
    <thead><tr><th>ID</th><th>Наименование</th><th>ОГРН</th><th>ИНН</th><th>КПП</th><th>Адрес</th><th>E-mail</th><th>Телефон</th></tr><thead>
    <tbody>
    @foreach ($clients as $client)
        <tr><td>{{$client->id}}</td><td>{{$client->title}}</td><td>{{$client->ogrn}}</td><td>{{$client->inn}}</td><td>{{$client->kpp}}</td><td>{{$client->address}}</td><td>{{$client->email}}</td><td>{{$client->tel}}</td></tr>
    @endforeach
    </tbody>
</table>