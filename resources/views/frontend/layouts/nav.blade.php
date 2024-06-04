<nav class="nav-main-menu">
    @php
        $public_menu = \Menu::getByName('Navigation Menu');
    @endphp
    <ul class="main-menu">
        @foreach ($public_menu as $menu)
            @if ($menu['child'])
                <li class="has-children"><a class="" href="{{ url($menu['link']) }}">{{ GoogleTranslate::trans($menu['label'], app()->getLocale()) }}</a>
                <ul class="sub-menu">
                    @foreach ($menu['child'] as $child)
                        <li><a href="{{ url($child['link']) }}">{{ GoogleTranslate::trans($child['label'], app()->getLocale()) }}</a></li>
                    @endforeach
                </ul>
            </li>
            @else
                <li class="has-children"><a class="" href="{{ url($menu['link']) }}">{{ GoogleTranslate::trans($menu['label'], app()->getLocale()) }}</a></li>
            @endif
        @endforeach
    </ul>
</nav>
