<?php function sidebar($menuItems) {
ob_start();
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <?php foreach ($menuItems['current_user_sidebar_menu'] as $item): ?>
                    <?php
                    $hasSubmenu = !empty($item['submenu']);
                    $isActive = $item['name'] === $menuItems['current_page'] || ($hasSubmenu && in_array($menuItems['current_page'], array_column($item['submenu'], 'name')));
                    ?>
                    <li class="<?php echo $hasSubmenu ? 'submenu' : ''; ?> <?php echo $isActive ? 'active' : ''; ?>">
                        <a href="<?php echo $item['link']; ?>">
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
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="content">
<?php
}