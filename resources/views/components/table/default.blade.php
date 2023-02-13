<div class="table-responsive">
    <table class="table">
        <thead class="table-light">
        <tr>
            @foreach($headers as $header)
            <th scope="col" class="text-center">{{$header}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($body as $item)
            <tr>
                <td class="text-center">{{$item->title}}</td>
                <td class="text-center"><a href="user?id={{$item->user->id}}">{{$item->user->name}}</a></td>
                <td class="text-center">{{$item->created_at}}</td>
                <td class="text-center">{{$item->updated_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
