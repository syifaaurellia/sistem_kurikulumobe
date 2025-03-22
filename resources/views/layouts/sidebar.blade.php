<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('sbadmin2/img/logo_kampus.png') }}" alt="Logo Kampus" style="width: 40px; height: auto;">
        </div>
        <div class="sidebar-brand-text mx-3 font-weight-bold">FAKULTAS TEKNIK UPB</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- User Profil -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User Profil</span>
        </a>
    </li>

    <!-- Master Data -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
            aria-expanded="false" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Utama</h6>

                <!-- Rumusan SKL -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuSKL"
                    aria-expanded="false" aria-controls="submenuSKL">
                    <i class="fas fa-graduation-cap"></i> Rumusan SKL
                </a>
                <div id="submenuSKL" class="collapse pl-3">
                    <a class="collapse-item" href="{{ route('profil-lulusan.index') }}">Profil Lulusan</a>
                    <a class="collapse-item" href="{{ route('cpl-prodi.index') }}">CPL Prodi</a>
                    <a class="collapse-item" href="{{ route('cpl-pl.index') }}">CPL-PL</a>
                </div>

                <!-- Penetapan BK -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuBK"
                    aria-expanded="false" aria-controls="submenuBK">
                    <i class="fas fa-book"></i> Penetapan BK
                </a>
                <div id="submenuBK" class="collapse pl-3">
                    <a class="collapse-item" href="{{ route('bahan-kajian.index') }}">Bahan Kajian</a>
                    <a class="collapse-item" href="{{ route('cpl-bk.index') }}">CPL-BK</a>
                    <a class="collapse-item" href="{{ route('mata-kuliah.index') }}">Daftar Mata Kuliah</a>
                    <a class="collapse-item" href="{{ route('bk-mk.index') }}">BK-MK</a>
                </div>

                <!-- Mata Kuliah & SKS -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuMKSKS"
                    aria-expanded="false" aria-controls="submenuMKSKS">
                    <i class="fas fa-list"></i> Mata Kuliah & SKS
                </a>
                <div id="submenuMKSKS" class="collapse pl-3">
                    <a class="collapse-item" href="{{ route('cpl-mk.index') }}">CPL-MK</a>
                    <a class="collapse-item" href="{{ route('cpl-bk-mk.index') }}">CPL-BK-MK</a>
                    <a class="collapse-item" href="{{ route('susunan_mata_kuliah.index') }}">Susunan Mata Kuliah</a>
                    <a class="collapse-item" href="{{ route('mk-cpmk.index') }}">MK-CPMK</a>
                </div>

                <!-- Matriks & Kurikulum -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuKurikulum"
                    aria-expanded="false" aria-controls="submenuKurikulum">
                    <i class="fas fa-table"></i> Matriks & Kurikulum
                </a>
                <div id="submenuKurikulum" class="collapse pl-3">
                    <a class="collapse-item" href="{{ route('cpmk.index') }}">Rumusan CPMK</a>
                    <a class="collapse-item" href="{{ route('sub_cpmk.index') }}">Sub CPMK</a>
                    <a class="collapse-item" href="{{ route('organisasi_mata_kuliah.index') }}">Organisasi MK</a>
                    <a class="collapse-item" href="{{ route('cpl_cpmk_mk.index') }}">CPL-CPMK-MK</a>
                    <a class="collapse-item" href="{{ route('pemenuhan-cpl.index') }}">Pemenuhan CPL</a>
                    <a class="collapse-item" href="{{ route('pemetaan.index') }}">MK-CPL-CPMK</a>
                    <a class="collapse-item" href="{{ route('pemetaansubcpmk.index') }}">MK-CPMK-SubCPMK</a>
                </div>

                <!-- Asesmen Pembelajaran -->
                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#submenuAsesmen"
                    aria-expanded="false" aria-controls="submenuAsesmen">
                    <i class="fas fa-check-circle"></i> Asesmen Pembelajaran
                </a>
                <div id="submenuAsesmen" class="collapse pl-3">
                <a class="collapse-item" href="{{ route('penilaian.index') }}">Metode Penilaian</a>
                <a class="collapse-item" href="{{ route('tahap_penilaian.index') }}">Tahap Penilaian</a>
                <a class="collapse-item" href="{{ route('bobot-penilaian.index') }}">Bobot Penilaian MK-CPL-CPMK</a>
                <a class="collapse-item" href="{{ route('bobot-penilaian-cpl.index') }}">Bobot Penilaian CPL-MK-CPMK</a>
                <a class="collapse-item" href="{{ route('nilai_akhir.index') }}">Nilai Akhir MK</a>
                <a class="collapse-item" href="{{ route('nilai_akhir_cpl.index') }}">Nilai Akhir CPL</a>
                </div>

            </div>
        </div>
    </li>

</ul>
