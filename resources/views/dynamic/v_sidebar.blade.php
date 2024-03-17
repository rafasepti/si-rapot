<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::is('/dashboard') ? '' : 'collapsed' }}" href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

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
    </ul>
</aside>
<!-- End Sidebar-->