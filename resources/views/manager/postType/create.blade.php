@include('manager/mainMenu')
<div class="container">
    <form
        action="{{$menu['dashboard'] . '/' . $settings['postTypeBase'] . '/' . $postType['slug'] . '/' . ($nextAction ?? null)}}"
        method="post"
    >
        @csrf
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
@include('manager/footer')
