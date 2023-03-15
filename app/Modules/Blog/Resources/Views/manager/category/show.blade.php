@extends('manager.index')
@section('mainContent')
    <div class="container">
        @if($errors->any())
            <x-alerts.errors :errors/>
        @elseif(isset($result) && $result == 'success')
            <x-alerts.success/>
        @endif
        <form
            action="{{url()->route($nextAction,['category' => $data->id])}}"
            method="{{ !isset($method) || in_array($method, ['post', 'put', 'patch']) ? 'post' : $method}}"
        >
            @csrf
            @if(isset($method))
                @method($method)
            @endif

            @foreach($postType['components'] as $component)
                @if(isset($data))
                    <x-dynamic-component component="form.{{$component}}" :$lang :$data/>
                @else
                    <x-dynamic-component component="form.{{$component}}" :$lang/>
                @endif

            @endforeach
            <input type="submit" class="btn btn-primary mb-3" value="{{$lang['store']}}">

        </form>
        <form
            action="{{url()->route($nextAction,['category' => $data->id])}}"
            method="post"
        >
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger mb-3" value="{{$lang['remove']}}">
        </form>

    </div>
@endsection
