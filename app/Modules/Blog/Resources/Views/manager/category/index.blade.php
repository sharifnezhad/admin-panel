@extends('manager.index')
@section('mainContent')
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col" class="text-center">عنوان</th>
                <th scope="col" class="text-center">تاریخ ایجاد</th>
                <th scope="col" class="text-center">تاریخ آخرین تغییر</th>
                <th scope="col" class="text-center">جزئیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td class="text-center">{{$item->title}}</td>
                    <td class="text-center">{{$item->created_at}}</td>
                    <td class="text-center">{{$item->updated_at}}</td>
                    <td class="text-center"><a href="{{url()->route($nextAction,['category' => $item->id])}}" style="color: #0d6efd"><i class="fa fa-eye"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $data->links() !!}
@endsection
