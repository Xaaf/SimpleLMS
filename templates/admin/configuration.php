<div class="wrap">
    <h1>Configuration</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields("simplelms_admin_configuration");
        do_settings_sections("simplelms_config");
        submit_button();
        ?>
    </form>
</div>