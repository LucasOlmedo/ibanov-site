<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap float-right">
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="data:image/png;base64, {{ auth()->user()->avatar }}" alt="Avatar"/>
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ auth()->user()->nome }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <img src="data:image/png;base64, {{ auth()->user()->avatar }}" alt="Avatar"/>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">{{ auth()->user()->nome }}</h5>
                                        <span class="email">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Perfil</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Configurações</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <form id="form-logout" action="{{ route('logout') }}" method="post">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="" onclick="$('#form-logout').trigger('submit'); return false;">
                                        <i class="zmdi zmdi-power"></i>Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->
