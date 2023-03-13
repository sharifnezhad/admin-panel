<div class="main-container">
    <!-- My Side Barre -->
    <div class="side-bar">
        <div class="menu">
            @foreach($menu as $key => $item)
                @if(!is_array($item))
                    <div class="item"><a href="{{$item}}">{{$lang[$key]?: $key}}</a></div>
                @else
                    <div class="item">
                        <a class="sub-btn">{{$key}}<i class="fa fa-caret-left"></i></a>
                        <div class="sub-menu">
                            @foreach($item['sub_menu'] as $title => $link)
                                <a href="{{$menu['dashboard'] . '/' . $link}}">{{$title}}</a>
                            @endforeach

                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- My Main Content -->
    <div class="mainContent">
        <nav class="header">
            <div id="user">
                <div class="avatar"></div>
                <p>@if(isset($user->id))
                        سلام {{$user->name}}
                    @endif</p>
            </div>
        </nav>
