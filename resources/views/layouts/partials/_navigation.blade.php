<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">WMD Visit Web</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            選單
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                @if ($menu_items->count())
                    @foreach ($menu_items as $k => $menu_item)
                        @if (($menu_item->page_id && is_object($menu_item->page)) || !$menu_item->page_id)
                            @if ($menu_item->children->count())
                                <li class="nav-item dropdown {{ ($k==0)?' fistitem':'' }}">
                                    <a href="#" class="nav-link js-scroll-trigger dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $menu_item->name }} <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach ($menu_item->children as $i => $child)
                                            <li class="{{ ($child->url() == Request::url())?'active':'' }}"><a href="{{ $child->url() }}">{{ $child->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item {{ ($k==0)?' fistitem':'' }} {{ ($menu_item->url() == Request::url())?' active':'' }}">
                                    <a href="{{ $menu_item->url() }}" class="nav-link js-scroll-trigger">{{ $menu_item->name }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger" href="#services">Services</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger" href="#about">About</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger" href="#team">Team</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link js-scroll-trigger" href="#contact">Contact</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</nav>