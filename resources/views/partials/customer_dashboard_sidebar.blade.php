<div class="bs_customer_sidebar">
	<a href="{{url('my-account/dashboard')}}" class="{{ (request()->is('my-account/dashboard')) ? 'active' : '' }}"><i class="fa fa-home fa-1x"></i> Dashboard</a>

	<a href="{{url('my-account/orders')}}" class="{{ (request()->is('my-account/orders')) ? 'active' : '' }}"><i class="fa fa-square fa-1x"></i> Orders</a>

	<a href="{{url('my-account/wishlist')}}" class="{{ (request()->is('my-account/wishlist')) ? 'active' : '' }}"><i class="fa fa-heart fa-1x"></i> Wishlist</a>

	<a href="{{url('my-account/settings')}}" class="{{ (request()->is('my-account/settings')) ? 'active' : '' }}"><i class="fa fa-cog fa-1x"></i> Settings</a>

	<a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
        <i class="fa fa-arrow-left fa-1x"></i> {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>