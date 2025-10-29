<div id="sidebar">
    @if(Auth::user()->role ==1)  
    @include('layouts.Menu.menuAdmin')  
    @elseif(Auth::user()->role ==2)
    @include('layouts.Menu.menuUser')
    @endif
</div>