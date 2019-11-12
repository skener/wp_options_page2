<?php

/**
 * Plugin name: Simple Options page admin page
 * Plugin URI:        https://skener.github.io/cv
 * Description:       Create Options page in Admin area for settings .
 * Version:           1.0.0
 * Author:            Andriy Tserkovnyk <skenerster@gmail.com>
 * Author URI:        https://skener.github.io/cv
 * Text Domain:       skener
 *
 * @package WordPress.
 */



function add_theme_menu_item()
{
	add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

function theme_settings_page()
{
	?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
			<?php
			settings_fields("section-1");
			do_settings_sections("theme-options");
			submit_button();
			?>
        </form>
    </div>
	<?php
}


function display_option1() {
	?>
    <input type="text" name="option1" value="<?php echo get_option( 'option1' ); ?>"/>
	<?php
}

function display_option2() {
	?>
    <input type="text" name="option2" value="<?php echo get_option( 'option2' ); ?>"/>
	<?php
}

function display_layout_element() {
	?>
    <input type="checkbox" name="theme_layout" value="1" <?php checked( 1, get_option( 'theme_layout' ), true ); ?> />
	<?php
}


function logo_display() {
	?>
    <input type="file" name="logo"/>
	<?php echo get_option( 'logo' ); ?>
	<?php
}

function handle_logo_upload() {
	if ( ! empty( $_FILES["demo-file"]["tmp_name"] ) ) {
		$urls = wp_handle_upload( $_FILES["logo"], array( 'test_form' => false ) );
		$temp = $urls["url"];

		return $temp;
	}

	return $option;
}


function display_theme_panel_fields() {
	add_settings_section( "section-1", "All Settings", null, "theme-options" );

	add_settings_field( "option1", "Twitter Profile Url", "display_option1", "theme-options", "section-1" );
	add_settings_field( "option2", "Facebook Profile Url", "display_option2", "theme-options", "section-1" );
	add_settings_field( "theme_layout", "Do you want the layout to be responsive?", "display_layout_element", "theme-options", "section-1" );
	add_settings_field( "logo", "Logo", "logo_display", "theme-options", "section-1" );

	register_setting( "section-1", "option1" );
	register_setting( "section-1", "option2" );
	register_setting( "section-1", "theme_layout" );
	register_setting( "section-1", "logo", "handle_logo_upload" );
}

add_action( "admin_init", "display_theme_panel_fields" );
add_action("admin_menu", "add_theme_menu_item");