<?php 
/*
Plugin Name: Blog Post Schema
Description: <strong>Blog Post Schema</strong> is a simple, light-weight, powerful plugin that generate schema data structure for each blog post, article, and breadcrumbs.
Author: Webackstop
Author URI: https://webackstop.com
Version: 1.0.0
Text Domain: blog-post-schema
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Domain Path:  /languages
*/

if ( !defined( 'ABSPATH' ) ) {
    exit();
}

require_once __DIR__ . '/blog-post-schema.php';

/**
 * Plugin Text Domain load
 */

function bps_plugin_init() {
    load_plugin_textdomain( 'blog-post-schema', false, dirname( plugin_basename( __FILE__ ) . '/languages' ) );
}
add_action( 'plugins_loaded', 'bps_plugin_init' );

/**
 * Pro Link
 */

function bps_settings_link( $links ) {
    $bps_settings = array( '<a href="' . esc_url( 'https://webackstop.com/submit-ticket' ) . '" target="_blank"  style="color: green; font-weight: bold">Get Support</a>', );
    return array_merge( $bps_settings, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bps_settings_link' );


/**
 * Admin Assets
 */
function bps_admin_assets( $screen ) {

    if ( $screen == 'plugins_page_bps_page' ) {
        wp_enqueue_style( 'bps-admin-css', plugins_url( 'admin/css/admin.css', __FILE__ ), array(), time(), 'all' );
    }

}

add_action( 'admin_enqueue_scripts', 'bps_admin_assets' );

/**
 * Admin Support Page
 */
function bps_admin_support_page() {
    add_submenu_page( 'plugins.php', __( 'Blog Post Schema', 'blog-post-schema' ), __( 'Blog Post Schema', 'blog-post-schema' ), 'manage_options', 'bps_page', 'bps_admin_page_callback' );
}
add_action( 'admin_menu', 'bps_admin_support_page' );

// call back 
function bps_admin_page_callback() {
    ?>
    <div class="ptsp_admin_page">
    	<div class="bps_header">
    		<h2><?php echo __( 'Blog Post Schema', 'blog-post-schema' ); ?></h2>
    		<p>Thanks for using <strong>Blog Post Schema</strong>. It is a simple, light-weight, powerful plugin that generate schema data structure for each post on single post view page. </p>
    		<p><span style="color: #ab5700"><strong>*No Extra Settings are required</strong> </span>. Use <a target="_blank" href="https://search.google.com/structured-data/testing-tool"> Google Schema Checker Tool</a> to check out your site.</p>
    	</div>
        <div class="ptsp_support_blocks">
            <div class="single-block">
                <div class="icon">
                    <i class="fa fa-support"></i>
                </div>
                <div class="help_link">
                    <span><?php echo __( 'Need Help?', 'blog-post-schema' ); ?></span>
                    <?php echo '<a href="https://webackstop.com/submit-ticket/" target="_blank">' . __( 'Create Support Ticket', 'blog-post-schema' ) . '</a>'; ?>
                </div>
            </div>
            <div class="single-block">
                <div class="icon">
                    <i class="fa fa-thumbs-up"></i>
                </div>
                <div class="help_link">
                    <span><?php echo __( 'Like this plugin?', 'blog-post-schema' ); ?></span>
                    <?php echo '<a href="https://wordpress.org/plugins/blog-post-schema/#reviews" target="_blank">' . __( 'Leave a Positive Review', 'blog-post-schema' ) . '</a>'; ?>
                </div>
            </div>
            <div class="single-block">
                <div class="icon">
                    <i class="fa fa-envelope-open-o"></i>
                </div>
                <div class="help_link">
                    <span><?php echo __( 'Have a Freelance Work?', 'blog-post-schema' ); ?></span>
                    <?php echo '<a href="https://webackstop.com/contact/" target="_blank">' . __( 'Contact Us', 'blog-post-schema' ) . '</a>'; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/*
* Redirecting
*/
function bps_user_redirecting( $plugin ) {
    if ( plugin_basename( __FILE__ ) == $plugin ) {
        wp_redirect( admin_url( 'plugins.php?page=bps_page' ) );
        die();
    }
}

add_action( 'activated_plugin', 'bps_user_redirecting' );


