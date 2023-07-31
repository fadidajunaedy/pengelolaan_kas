<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div class="flex justify-center items-center gap-2">
        <img src="{{ asset('images/koperasi.png')}}" alt="" style="height: 32px;"><b class="font-black">KAS KOPERASI</b>
      </div>
    </div>
    <div class="menu is-menu-main">
      <ul class="menu-list">
        <li class="{{ request()->path() == '/' ? 'active' : '' }}">
          <a href="{{ url('/')}}">
            <span class="icon"><i class="mdi mdi-view-dashboard"></i></span>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
      </ul>
        <p class="menu-label">Data Laporan UKM</p>
        <ul class="menu-list">
          <li class="{{ request()->path() == 'penerimaan' ? 'active' : '' }}">
            <a href="{{ url('/penerimaan')}}">
              <span class="icon"><i class="mdi mdi-cash"></i></span>
              <span class="menu-item-label">Penerimaan</span>
            </a>
          </li>
          <li class="{{ request()->path() == 'pengeluaran' ? 'active' : '' }}">
            <a href="{{ url('/pengeluaran')}}">
              <span class="icon"><i class="mdi mdi-cash-minus"></i></span>
              <span class="menu-item-label">Pengeluaran</span>
            </a>
          </li>
          <li>
            <a class="dropdown">
              <span class="icon"><i class="mdi mdi-file-chart"></i></span>
              <span class="menu-item-label">Laporan</span>
              <span class="icon"><i class="mdi mdi-arrow-up-drop-circle"></i></span>
            </a>
            <ul>
              <li>
                <a href="{{ url('/laporan-penerimaan')}}">
                  <span class="icon"><i class="mdi mdi mdi-cash"></i></span>
                  <span>Penerimaan</span>
                </a>
              </li>
              <li>
                <a href="{{ url('/laporan-pengeluaran')}}">
                  <span class="icon"><i class="mdi mdi-cash-minus"></i></span>
                  <span>Pengeluaran</span>
                </a>
              </li>
              <li>
                <a href="{{ url('/laporan-rekapitulasi')}}">
                  <span class="icon"><i class="mdi mdi-file-chart"></i></span>
                  <span>Rekapitulasi</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="{{ request()->path() == 'grafik' ? 'active' : '' }}">
            <a href="{{ url('/grafik')}}">
              <span class="icon"><i class="mdi mdi-chart-bell-curve"></i></span>
              <span class="menu-item-label">Grafik</span>
            </a>
          </li>
          @if (Auth::guard('admins')->check())
          <li class="{{ request()->path() == 'users' ? 'active' : '' }}">
            <a href="{{ url('/users')}}">
              <span class="icon"><i class="mdi mdi-account-group"></i></span>
              <span class="menu-item-label">Manajemen Bendahara</span>
            </a>
          </li>
          <li class="{{ request()->path() == 'anggota' ? 'active' : '' }}">
            <a href="{{ url('/anggota')}}">
              <span class="icon"><i class="mdi mdi-account-group"></i></span>
              <span class="menu-item-label">Manajemen Anggota</span>
            </a>
          </li>
          @endif
          <li class="{{ request()->path() == 'password' ? 'active' : '' }}">
            <a href="{{ url('/password')}}">
              <span class="icon"><i class="mdi mdi-lock"></i></span>
              <span class="menu-item-label">Ubah Password</span>
            </a>
          </li>
        </ul>
    </div>
  </aside>