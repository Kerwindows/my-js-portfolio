<?php

function sidebar($menuItems) {
    ?>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="menu-title">Main</li>
            <?php foreach ($menuItems['current_user_sidebar_menu'] as $item): ?>
                <?php
                $hasSubmenu = !empty($item['submenu']);
                $isActive = $item['name'] === $menuItems['current_page'] || ($hasSubmenu && array_search($menuItems['current_page'], array_column($item['submenu'], 'name')) !== false);
                ?>
                <li class="submenu <?php echo $isActive ? 'active' : ''; ?>">
                    <a href="<?php echo $item['link']; ?>" class="<?php echo $hasSubmenu ? 'subdrop' : ''; ?> <?php echo $isActive ? 'active' : ''; ?>">
                        <span class="menu-side"><img src="<?php echo $item['icon']; ?>" alt=""></span>
                        <span><?php echo $item['title']; ?></span>
                        <?php if ($hasSubmenu): ?>
                            <span class="menu-arrow"></span>
                        <?php endif; ?>
                    </a>
                    <?php if ($hasSubmenu): ?>
                        <ul style="display: <?php echo $isActive ? 'block' : 'none'; ?>;">
                            <?php foreach ($item['submenu'] as $submenu): ?>
                                <li><a href="<?php echo $submenu['link']; ?>" class="<?php echo ($submenu['name'] === $menuItems['current_page']) ? 'active' : ''; ?>"><?php echo $submenu['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="logout-btn">
            <a href="login.html"><span class="menu-side"><img src="<?php echo base_url() ?>/assets/img/icons/logout.svg" alt=""></span> <span>Logout</span></a>
        </div>
    </div>
        </div>
    </div>
    <div class="page-wrapper">
    <div class="content">
    <?php
}