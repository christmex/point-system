{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="Add-ons" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="Authentication" />
    <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
    <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>
<x-backpack::menu-item title="Jenis Pelanggaran Siswa" icon="la la-exclamation" :link="backpack_url('penalty-type')" />
<x-backpack::menu-item title="Daftar Ruang Kelas" icon="la la-chalkboard-teacher" :link="backpack_url('classroom')" />
<x-backpack::menu-item title="Murid" icon="la la-user-graduate" :link="backpack_url('student')" />
<x-backpack::menu-item title="Student penalties" icon="la la-question" :link="backpack_url('student-penalty')" />