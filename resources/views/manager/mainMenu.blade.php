@include('manager/header')
<!-- My Side Barre -->
<div class="sideBarre">
    <div class="sideBarre__logo">
        <div class="sideBarre__cercle">

        </div>
        <h1>serein</h1>
    </div>
    <div class="sideBarre__menu">
        <ul>
            @foreach($menu as $key => $item)
                @if(!is_array($item))
                    <li><a href="{{$item}}">{{$key}}</a></li>
                @else
                    <li>
                        <div class="iocn-link">
                            <a href="#">
                                <i class='bx bx-plug'></i>
                                <span class="link_name">{{$key}}</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            @foreach($item['sub_menu'] as $title => $link)
                                <li><a href="{{$link}}">{{$title}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<!-- My Main Content -->
<div class="mainContent">
    <nav>
        <div id="user">
            <div class="avatar"></div>
            <p>@if($user->id) سلام {{$user->name}}@endif</p>
        </div>
    </nav>
