<div class="main-menu menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" style="position: relative;">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">  
            <li class="nav-item {{ isset($list_menu) &&  $list_menu == 'menu-1' ? 'active' : ''}}">
                <a href="{{ route('admin.templates.index', '1') }}">New User</a>
            </li>
            <li class="nav-item {{ isset($list_menu) &&  $list_menu == 'menu-2' ? 'active' : ''}}">
                <a href="{{ route('admin.templates.index', '2') }}">Verification Link</a>
            </li>
        </ul>
    </div>
</div> 