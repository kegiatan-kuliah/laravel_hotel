{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Guests" icon="la la-user" :link="backpack_url('guest')" />
<x-backpack::menu-item title="Rooms" icon="la la-building" :link="backpack_url('room')" />
<x-backpack::menu-item title="Reservations" icon="la la-clipboard" :link="backpack_url('reservation')" />
<x-backpack::menu-item title="Payments" icon="la la-money" :link="backpack_url('payment')" />