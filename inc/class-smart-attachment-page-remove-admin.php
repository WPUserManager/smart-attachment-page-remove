<?php

/**
 * The Smart Attachment Page Remove admin plugin class
 *
 * @since  4.0.0
 */
 
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin plugin class
 */
if ( !class_exists( 'PP_Smart_Attachment_Page_Remove_Admin' ) ) {
  
  class PP_Smart_Attachment_Page_Remove_Admin extends WPUMPPF1_Admin {

    
    /**
	   * Do Init
     *
     * @since 4.0.0
     * @access public
     */
    public function init() {
      
      $this->add_actions( array( 
        'admin_init',
        'admin_menu'
      ) );
    
    }
    
    
    /**
     * init admin 
     * moved to PP_Smart_Attachment_Page_Remove_Admin in v 4.0.0
     */
    function action_admin_init() {
      
      $this->add_setting_sections(
      
        array(
          
          array(
        
            'section' => 'advanced',
            'order'   => 10,
            'title'   => esc_html__( 'Advanced', 'smart-attachment-page-remove' ),
            'icon'    => 'advanced',
            'html'    => $this->core_setting_note(),
            'fields' => array(
              array(
                'key'      =>'send_http_410',
                'callback' => 'admin_410'
              )
            )
        
          )
          
        )
        
      );
      
    }
    
    /**
     * explain WordPress's own attachment pages setting (WP 6.4+)
     *
     * @since  4.0.6
     * @access private
     * @return string HTML
     */
    private function core_setting_note() {

      $note = esc_html__( 'Since WordPress 6.4, sites installed on 6.4 or later have attachment pages turned off by WordPress itself: their URLs redirect to the file. Older sites keep them. This plugin removes attachment pages on any site, and sends a 404 or 410 instead of redirecting.', 'smart-attachment-page-remove' );

      $core = get_option( 'wp_attachment_pages_enabled' );

      if ( false !== $core ) {

        $note .= ' ' . ( $core ? esc_html__( "On this site WordPress's own setting has attachment pages turned on.", 'smart-attachment-page-remove' ) : esc_html__( "On this site WordPress's own setting has attachment pages turned off.", 'smart-attachment-page-remove' ) );

      }

      return '<p><span class="dashicons dashicons-info"></span>&nbsp;' . $note . '</p>';

    }


    /**
     * handle the HTTP 410 option
     * moved to PP_Smart_Attachment_Page_Remove_Admin in v 4.0.0
     */
    function admin_410() {
        
      $this->print_slider_check( 
        'send_http_410', 
        esc_html__( 'Send HTTP status 410 instead of HTTP status 404', 'smart-attachment-page-remove' ),
        false,
        false,
        '<span class="dashicons dashicons-info"></span>&nbsp;' . esc_html__( 'HTTP status code 404 indicates that the requested URL could not be found. This is the default code always sent by WordPress when a URL can not be found. HTTP status 404 does not provide any further information why a URL was not found. HTTP status code 410 on the other hand indicates that the requested URL is no longer available and will not be available again. If your attachment pages already have been indexed by search engines, HTTP status 410 informs them to immediately delete those pages from their index. This should speed up removal. Regardless, in case of attachment pages it makes more sense to use HTTP status 410 anyway. It is safe to activate this option in any case. This option is not activated by default only because it is not the usual behavior of WordPress. There are no negative effects in using HTTP 410. Just decide yourself.', 'smart-attachment-page-remove' )
      );
      
    }
    
    
    /**
     * create the menu entry
     * moved to PP_Smart_Attachment_Page_Remove_Admin in v 4.0.0
     */
    function action_admin_menu() {
      $screen_id = add_options_page( esc_html__( 'Attachment Pages', 'smart-attachment-page-remove' ), esc_html__( 'Attachment Pages', 'smart-attachment-page-remove' ), 'manage_options', 'smartattachmentpageremovesettings', array( $this, 'show_admin' ) );
      $this->set_screen_id( $screen_id );
    }
    
   
    /**
     * show admin page
     * moved to PP_Smart_Attachment_Page_Remove_Admin in v 4.0.0
     */
    function show_admin() {
      
      $this->show( 'manage_options' );
      
    }
    
    /**
     * create nonce
     *
     * @since  5.0.0
     * @access private
     * @return string Nonce
     */
    private function get_nonce() {
      
      return wp_create_nonce( 'pp_smart_archive_page_remove_dismiss_admin_notice' );
      
    }
    
    
    /**
     * check nonce
     *
     * @since  5.0.0
     * @access private
     * @return boolean
     */
    private function check_nonce() {
      
      return check_ajax_referer( 'pp_smart_archive_page_remove_dismiss_admin_notice', 'securekey', false );
      
    }

  }
  
}

?>