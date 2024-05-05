<nav class="nav-main-menu">
    @php
        $public_menu = \Menu::getByName('Navigation Menu');
    @endphp
    <ul class="main-menu">
        @foreach ($public_menu as $menu)
            @if ($menu['child'])
                <li class="has-children"><a class="" href="{{ url($menu['link']) }}">{{ $menu['label'] }}</a>
                <ul class="sub-menu">
                    @foreach ($menu['child'] as $child)
                        <li><a href="{{ url($child['link']) }}">{{ $child['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            @else
                <li class="has-children"><a class="" href="{{ url($menu['link']) }}">{{ $menu['label'] }}</a></li>
            @endif
        @endforeach
    </ul>
</nav>
