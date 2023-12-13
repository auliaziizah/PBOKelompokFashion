@php
$sidebarItems = [
    [
        "text" => "Dashboard",
        "icon" => "fas fa-home",
        "href" => route('home'),
        "can" => 'dashboard'
    ],
    [
        "text" => "Kelola Akun",
        "icon" => "fas fa-shopping-cart",
        "href" => route('akun.index'),
        "can" => 'admin'
    ],
    [
        "text" => "Kelola Barang",
        "icon" => "fas fa-tshirt",
        "can" => 'admin',
        "items" => [
            [
                "text" => "Tambah Barang",
                "icon" => "add",
                "href" => route('barang.tambahdatabarang'),
                "can" => 'admin'
            ],
            [
                "text" => "Tabel Barang",
                "icon" => "far fa-circle",
                "href" => route('barang.index'),
                "can" => 'admin'
            ]
        ]
    ],
    [
        "text" => "Kelola Transaksi",
        "icon" => "fas fa-money-bill-wave-alt",
        "href" => route('transaksi.index'),
        "can" => 'admin'
    ],
    [
        "text" => "Tambah Transaksi",
        "icon" => "fas fa-shopping-cart",
        "href" => route('transaksi.create'),
        "cannot" => 'admin'
    ]
];
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('vendor/adminlte3/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ClothChic</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                @foreach ($sidebarItems as $item)
                    @if (isset($item['can']) && Gate::allows($item['can']))
                        @if (isset($item['items']))
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon {{ $item['icon'] }}"></i>
                                    <p>
                                        {{ $item['text'] }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($item['items'] as $subItem)
                                        @if (isset($subItem['can']) && Gate::allows($subItem['can']))
                                            <li class="nav-item">
                                                <a href="{{ $subItem['href'] }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $subItem['text'] }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ $item['href'] }}" class="nav-link">
                                    <i class="nav-icon {{ $item['icon'] }}"></i>
                                    <p>{{ $item['text'] }}</p>
                                </a>
                            </li>
                        @endif
                    @elseif (isset($item['cannot']) && Gate::denies($item['cannot']))
                        <li class="nav-item">
                            <a href="{{ $item['href'] }}" class="nav-link">
                                <i class="nav-icon {{ $item['icon'] }}"></i>
                                <p>{{ $item['text'] }}</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
