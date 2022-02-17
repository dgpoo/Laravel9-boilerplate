<!-- sidebar nav -->

<ul class="nav flex-column">
    <li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{route('dashboard')}}"> 
      <span data-feather="home"></span>
      {{__('Dashboard') }}
    </a>
    </li>
    
    <li class="nav-item">
        <a href="{{ route('users') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
        <span data-feather="users"></span>
        {{__('Users') }}
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('pages.index') }}" class="nav-link {{ request()->is('admin/pages') || request()->is('admin/pages/*') ? 'active' : '' }}">
        <span data-feather="align-left"></span>
        {{__('CMS Pages') }}
        </a>
    </li>
    
    <li class="nav-item">
        <a href="{{ route('setting') }}" class="nav-link {{ request()->is('admin/setting') || request()->is('admin/setting/*') ? 'active' : '' }}">
        <span data-feather="settings"></span>
        {{__('Setting') }}
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('languages') }}" class="nav-link {{ request()->is('admin/languages') || request()->is('admin/languages/*') ? 'active' : '' }}">
        <span data-feather="type"></span>
        {{__('Languages') }}
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('translation') }}" class="nav-link {{ request()->is('admin/translation') || request()->is('admin/translation/*') ? 'active' : '' }}">
        <span data-feather="book-open"></span>
        {{__('Translation') }}
        </a>
    </li>
    
</ul> 