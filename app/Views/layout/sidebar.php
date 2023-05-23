<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= site_url(session()->get('role').'/dashboard') ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <?php
                if (session()->get('role') == 'admin' || session()->get('role') == 'kepsek') {
                    if (session()->get('role') == 'admin') {
                ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="mdi mdi-database"></i>
                                <span>Master Data</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li><a href="<?= site_url('admin/kepala_sekolah') ?>"> Data Kepala Sekolah</a></li>
                                <li><a href="<?= site_url('admin/karyawan') ?>"> Data Karyawan</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= site_url('admin/gaji') ?>" class="waves-effect">
                                <i class="mdi mdi-cash-multiple"></i>
                                Data Gaji
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?= site_url(session()->get('role') . '/laporan') ?>" class="waves-effect">
                                <i class="fa fa-print"></i>
                                Laporan
                        </a>
                    </li>
                <?php } ?>
                <?php if(session()->get('role') == 'karyawan') { ?>
                    <li>
                        <a href="<?= site_url('karyawan/gaji') ?>" class="waves-effect">
                            <i class="mdi mdi-cash-multiple"></i>
                            Data Gaji
                        </a>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
    <!-- Sidebar -left -->

</div>