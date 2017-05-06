<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->        
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">                    
                <?php
                if ($active_page == 'dashboard') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                
                <a href="<?= site_url() ?>admin" >
                    <i class="mdi mdi-view-dashboard mdi-24px"></i>
                    <span>Dashboard</span>
                </a>
                </li>
                <?php
                if ($active_page == 'data') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                
                <a href="<?= ADMIN_WEBAPP_URL ?>data" class="waves-effect waves-block">
                    <i class="mdi mdi-chart-line mdi-24px"></i>
                    <span>Data</span>
                </a>                
                </li>
                <?php
                if ($active_page == 'history') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>   
                <a href="<?= ADMIN_WEBAPP_URL ?>history" class="waves-effect waves-block">
                    <i class="mdi mdi-format-list-bulleted mdi-24px"></i>
                    <span>Log History</span>
                </a>                

                </li>
                <?php
                if ($active_page == 'setting') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                  
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-account-settings-variant mdi-24px"></i>
                    <span>Setting</span>
                </a>
                <ul class="ml-menu" style="display: none;">                    
                    <li>
                        <a href="<?= site_url() ?>admin/setting/account" class="waves-effect waves-block">                                
                            <span>Login</span>
                        </a>                            
                    </li>
                </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);">Microcontroller - Class 0 </a> &copy; 2017
            </div>

        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <!-- #END# Right Sidebar -->
</section>