@include('manager/header')
<div class="container authpage">
    <div class="section_left">
        <div class="container">
            <i class="fas fa-user-plus fa-5x"></i>
            <h2>Sharif Web</h2>
            <p>Website designer and Backend Developer</p>
        </div>
    </div>
    <div class="login">
        <div class="container">
            <h1>{{$lang['login_page']}}</h1>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post">
                @csrf
                <input type="email" placeholder="{{$lang['attributes']['email']}}" name="email">
                <input type="password" placeholder="{{$lang['attributes']['password']}}" name="password"><br>
                <input type="checkbox" name="remember"><span>{{$lang['remember_me']}}</span>
                <button>{{$lang['login']}}</button>
            </form>
        </div>
    </div>

</div>

@include('manager/footer')
