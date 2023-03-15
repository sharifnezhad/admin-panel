@extends('manager.index')
@section('mainContent')
    <div class="container">
        @if($errors->any())
            <x-alerts.errors :errors/>
        @elseif(isset($result) && $result == 'success')
            <x-alerts.success/>
        @endif
        <form
            action="{{url()->route($nextAction)}}"
            method="{{ !isset($method) || in_array($method, ['post', 'put', 'patch']) ? 'post' : $method}}"
        >
            @csrf
            @if(isset($method))
                @method($method)
            @endif

            @foreach($postType['components'] as $component)
                @if(isset($post))
                    <x-dynamic-component component="form.{{$component}}" :$lang :$post/>
                @else
                    <x-dynamic-component component="form.{{$component}}" :$lang/>
                @endif

            @endforeach
            <input type="submit" class="btn btn-primary mb-3" value="{{$lang['store']}}">

        </form>

    </div>
@endsection
