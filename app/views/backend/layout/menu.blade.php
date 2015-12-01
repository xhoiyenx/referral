@if( isset($main_menu) )
  @foreach( $main_menu as $title => $menu )
  <ul class="sidebar-panel nav">
    <li class="sidetitle">{{ strtoupper($title) }}</li>
    @foreach( $menu as $menu_route => $menu_item )
    <li><a href="{{ route($menu_route) }}" class="{{ $menu_item['active'] }}"><span class="icon color5"><i class="fa {{ $menu_item['icon'] }}"></i></span> {{ $menu_item['name'] }}</a></li>
    @endforeach
  </ul>
  @endforeach
@endif