<div class="wrap">
    <h1>Dashboard</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields("simplelms_admin_options_group");
        do_settings_sections("simplelms");
        submit_button();
        ?>
    </form>
</div>