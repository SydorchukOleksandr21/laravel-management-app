<a href="{{  route($routeName)  }}"
   class="sidebar-link {{ request()->routeIs($routeName) ? 'active' : '' }}">
    <x-icon name="{{$iconName}}"/>
    <span>{{$label}}</span>
</a>
