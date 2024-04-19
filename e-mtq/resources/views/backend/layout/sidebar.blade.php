<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{url('/panel')}}"><img src="{{ asset('backend/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item{{ request()->is('panel') ? ' active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role ==='admin')
                <li class="sidebar-item  has-sub{{ request()->is('panel/masterdata/*') ? ' active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-database"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu{{ request()->is('panel/masterdata/*') ? ' active' : '' }}">
                        <li class="submenu-item{{ request()->is('panel/masterdata/petugas*') ? ' active' : '' }}">
                            <a href="{{ route('data.petugas') }}">Data Admin</a>
                        </li>
                        <li class="submenu-item{{ request()->is('panel/masterdata/users*') ? ' active' : '' }}">
                            <a href="{{ route('data.users') }}">Data Operator</a>
                        </li>
						<li class="submenu-item{{ request()->is('panel/masterdata/cabang*') ? ' active' : '' }}">
                            <a href="{{ route('data.cabang') }}">Data Cabang</a>
                        </li>
						<li class="submenu-item{{ request()->is('panel/masterdata/loot*') ? ' active' : '' }}">
                            <a href="{{ route('data.loot') }}">Data Loot</a>
                        </li>
						<li class="submenu-item{{ request()->is('panel/masterdata/activity*') ? ' active' : '' }}">
                            <a href="{{ route('data.activity') }}">Data Aktifitas</a>
                        </li>
                    </ul>
                </li>
                @endif
                
                <li class="sidebar-item  has-sub{{ request()->is('panel/penilaian/*') ? ' active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-database"></i>
                        <span>Data Penilaian</span>
                    </a>
                    <ul class="submenu{{ request()->is('panel/penilaian/*') ? ' active' : '' }}">
                        <li class="submenu-item{{ request()->is('panel/penilaian/penyisihan*') ? ' active' : '' }}">
                            <a href="{{ route('panel.cmtq') }}">Babak Penyisihan</a>
                        </li>
                        <li class="submenu-item{{ request()->is('panel/penilaian/final*') ? ' active' : '' }}">
                            <a href="{{ route('panelfinal.cmtq') }}">Babak Final</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item{{ request()->is('panel/pengaduan') ? ' active' : '' }}">
                    <form action="{{route('proses.logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block"> <i class="fas fa-sign-out-alt mt-2"></i> Logout</button>
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>