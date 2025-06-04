@php
    use App\Http\Helpers\Common;
@endphp

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">  
            <li class="nav-item"><a href="{{ route('admin.profile') }}"><span class="avatar avatar-online"><img src="{{ asset('assets/img/admins/'.Auth::user()->image) }}" alt="avatar"><i style="position: absolute !important; top: 20px;"></i></span><span class="menu-title" data-i18n="nav.dash.main"></span><span class="user-name" style="margin-left: 10px;">{{Auth::user()->name}}</span></a>
            </li> 
            <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li> 
            @if(Common::has_permission(Auth::user()->id, 'view-admins'))
                <li class="nav-item {{ Request::routeIs('admin.admins.index') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="nav.dash.main">Admins</span></a>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-users'))     
                <li class="nav-item {{ Request::routeIs('admin.users.index') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="nav.dash.main">Users</span></a>
                </li> 
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-roles') || Common::has_permission(Auth::user()->id, 'view-permissions'))
                <li class=" nav-item"><a href="#"><i class="fa fa-tasks"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Roles & Permissions</span></a>
                    <ul class="menu-content">   
                        @if(Common::has_permission(Auth::user()->id, 'view-roles'))
                            <li class="{{ Request::routeIs('admin.roles.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.roles.index') }}" data-i18n="nav.page_layouts.1_column">Roles</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-permissions'))
                            <li class="{{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.permissions.index') }}" data-i18n="nav.page_layouts.1_column">Permissions</a></li>
                        @endif
                    </ul>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-projects'))
                <li class="nav-item {{ Request::routeIs('admin.project.index') ? 'active' : '' }}"><a href="{{ route('admin.project.index') }}"><i class="fa fa-globe"></i><span class="menu-title" data-i18n="nav.dash.main">Projects</span></a>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-technologies'))
                <li class="nav-item {{ Request::routeIs('admin.technology.index') ? 'active' : '' }}"><a href="{{ route('admin.technology.index') }}"><i class="fa fa-database"></i><span class="menu-title" data-i18n="nav.dash.main">Technologies</span></a>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-blogs') || Common::has_permission(Auth::user()->id, 'view-blog-categories') || Common::has_permission(Auth::user()->id, 'view-blog-tags'))
                <li class=" nav-item"><a href="#"><i class="fa fa-cubes"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Blogs</span></a>
                    <ul class="menu-content">
                        @if(Common::has_permission(Auth::user()->id, 'view-blogs'))
                            <li class="{{ Request::routeIs('admin.blog.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.blog.index') }}" data-i18n="nav.page_layouts.1_column">Blogs</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-blog-categories'))
                            <li class="{{ Request::routeIs('admin.blogcategory.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.blogcategory.index') }}" data-i18n="nav.page_layouts.1_column">Categories</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-blog-tags'))
                            <li class="{{ Request::routeIs('admin.blogtag.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.blogtag.index') }}" data-i18n="nav.page_layouts.1_column">Tags</a></li>
                        @endif
                    </ul>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-home-page') || Common::has_permission(Auth::user()->id, 'view-cms-pages'))
                <li class=" nav-item"><a href="#"><i class="fa fa-list"></i><span class="menu-title" data-i18n="nav.page_layouts.main">CMS</span></a>
                    <ul class="menu-content"> 
                        @if(Common::has_permission(Auth::user()->id, 'view-home-page'))
                            <li class="{{ Request::routeIs('admin.home.edit') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.home.edit') }}" data-i18n="nav.page_layouts.1_column">Home Page</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-cms-pages'))
                            <li class="{{ Request::routeIs('admin.content.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.content.index') }}" data-i18n="nav.page_layouts.1_column">Pages</a></li>
                        @endif 
                    </ul>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-general') || Common::has_permission(Auth::user()->id, 'view-backup') || Common::has_permission(Auth::user()->id, 'view-personal-details') || Common::has_permission(Auth::user()->id, 'view-contacts') || Common::has_permission(Auth::user()->id, 'view-seo') || Common::has_permission(Auth::user()->id, 'view-countries'))
                <li class=" nav-item"><a href="#"><i class="fa fa-cog"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Settings</span></a>
                    <ul class="menu-content">   
                        @if(Common::has_permission(Auth::user()->id, 'view-general'))
                            <li class="{{ Request::routeIs('admin.settings.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.settings.index') }}" data-i18n="nav.page_layouts.1_column">General</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-backup'))
                            <li class="{{ Request::routeIs('admin.backup.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.backup.index') }}" data-i18n="nav.page_layouts.1_column">Backup</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-personal-details'))
                            <li class="{{ Request::routeIs('admin.personal.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.personal.index') }}" data-i18n="nav.page_layouts.1_column">Prsonal Details</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-contacts'))
                            <li class="{{ Request::routeIs('admin.contact.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.contact.index') }}" data-i18n="nav.page_layouts.1_column">Contacts</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-seo'))
                            <li class="{{ Request::routeIs('admin.seo.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.seo.index') }}" data-i18n="nav.page_layouts.1_column">SEO</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-countries'))
                            <li class="{{ Request::routeIs('admin.country.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.country.index') }}" data-i18n="nav.page_layouts.1_column">Countries</a></li>
                        @endif
                    </ul>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-maintenance')) 
                <li class="nav-item {{ Request::routeIs('admin.maintenance.index') ? 'active' : '' }}"><a href="{{ route('admin.maintenance.index') }}"><i class="fa fa-gavel"></i><span class="menu-title" data-i18n="nav.dash.main">Maintenance</span></a>
                </li>
            @endif    
            @if(Common::has_permission(Auth::user()->id, 'view-social-media'))
                <li class="nav-item {{ Request::routeIs('admin.social.index') ? 'active' : '' }}"><a href="{{ route('admin.social.index') }}"><i class="fa fa-share-alt"></i><span class="menu-title" data-i18n="nav.dash.main">Social Media</span></a>
                </li>
            @endif  
            @if(Common::has_permission(Auth::user()->id, 'view-tickets'))
                <li class="nav-item {{ Request::routeIs('admin.ticket.index') ? 'active' : '' }}"><a href="{{ route('admin.ticket.index') }}"><i class="fa fa-ticket"></i><span class="menu-title" data-i18n="nav.dash.main">Support Tickets</span></a>
                </li>
            @endif   
            @if(Common::has_permission(Auth::user()->id, 'view-email-config') || Common::has_permission(Auth::user()->id, 'view-email-templates'))
                <li class=" nav-item"><a href="#"><i class="fa fa-envelope"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Email</span></a>
                    <ul class="menu-content"> 
                        @if(Common::has_permission(Auth::user()->id, 'view-email-config'))
                            <li class="{{ Request::routeIs('admin.email.index') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.email.index') }}" data-i18n="nav.page_layouts.1_column">Config</a></li>
                        @endif    
                        @if(Common::has_permission(Auth::user()->id, 'view-email-templates'))
                            <li class="{{ Request::routeIs('admin.templates.index', '1') ? 'active' : '' }}"><a class="menu-item" href="{{ route('admin.templates.index', '1') }}" data-i18n="nav.page_layouts.1_column">Templates</a></li>
                        @endif  
                    </ul>
                </li>
            @endif
        </ul>
        <div class="version-info">
            Version: {{ Common::admin_version() }}
        </div>
    </div>
</div>