<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('admin.index') }}">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->route()->named('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fas fa-chart-bar"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->route()->named('admin.event.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.event.index') }}">
                        <i class="fa fa-calendar-check"></i> Eventos
                    </a>
                </li>
                <li class="{{ request()->route()->named('admin.post.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.post.index') }}">
                        <i class="fa fa-file-text"></i> Depoimentos
                    </a>
                </li>
                <li class="{{ request()->route()->named('admin.user.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fas fa-users"></i> Usuários
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
