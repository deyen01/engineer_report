<table>
    <thead><tr><th>ID</th><th>Наименование должности</th></tr><thead>
    <tbody>
    @foreach ($positions as $position)
        <tr><td>{{$position->id}}</td><td>{{ $position->title }}</td></tr>
    @endforeach
    </tbody>
</table>