<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- Menu Admin -->
      @if (Session::get('hak_akses')=='Admin')
      <li class="nav-heading">Data Master</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('siswa') ? '' : 'collapsed' }}" href="/siswa">
          <i class="bi bi-person"></i>
          <span>Siswa</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('mapel') ? '' : 'collapsed' }}" href="/mapel">
          <i class="bi bi-book"></i>
          <span>Mata Pelajaran</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('guru') ? '' : 'collapsed' }}" href="/guru">
          <i class="bi bi-people"></i>
          <span>Guru</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('kepsek') ? '' : 'collapsed' }}" href="/kepsek">
          <i class="bi bi-person-plus"></i>
          <span>Kepala Sekolah</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('kelas') ? '' : 'collapsed' }}" href="/kelas">
          <i class="bi bi-award"></i>
          <span>Kelas</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('tahunajaran') ? '' : 'collapsed' }}" href="/tahunajaran">
          <i class="bi bi-calendar-week"></i>
          <span>Tahun Ajaran</span>
        </a>
      </li>
      @endif
      <!-- END Menu Admin -->

      <!-- Menu Kepsek -->
      @if (Session::get('hak_akses')=='Kepala Sekolah')
      <li class="nav-heading">Data Master</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('siswa') ? '' : 'collapsed' }}" href="/siswa">
          <i class="bi bi-person"></i>
          <span>Siswa</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('guru') ? '' : 'collapsed' }}" href="/guru">
          <i class="bi bi-people"></i>
          <span>Guru</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('kelas') ? '' : 'collapsed' }}" href="/kelas">
          <i class="bi bi-award"></i>
          <span>Kelas</span>
        </a>
      </li>
      @endif
      <!-- END Menu Kepsek -->

      <!-- Menu Guru -->
      @if (Session::get('hak_akses')=='Guru')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('nilai') ? '' : 'collapsed' }}" href="/nilai">
          <i class="bi bi-award"></i>
          <span>Nilai</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('kelaswali') ? '' : 'collapsed' }}" href="/kelaswali">
          <i class="bi bi-person"></i>
          <span>Kelas</span>
        </a>
      </li>
      @endif
      <!-- END Menu Guru -->
    </ul>
</aside>
<!-- End Sidebar-->