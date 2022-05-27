<table>
    <thead><tr><th>ID</th><th>Наименование</th><th>ОКТМО</th></tr><thead>
    <tbody>
    @foreach ($locations as $location)
        <tr><td>{{$location->id}}</td><td>{{$location->title}}</td><td>{{$location->oktmo}}</td></tr>
    @endforeach
    </tbody>
</table>