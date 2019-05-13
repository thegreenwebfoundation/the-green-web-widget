<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function wporg_settings_init() {
 // register a new setting for "wporg" page
 register_setting( 'tgwf', 'tgwf_options' );

 // register a new section in the "wporg" page
 add_settings_section(
 'tgwf_section_carbon_txt',
 __( 'Carbon.txt', 'tgwf' ),
 'tgwf_section_carbon_txt_cb',
 'tgwf'
 );

 // register a new field in the "wporg_section_developers" section, inside the "wporg" page
 add_settings_field(
 'tgwf_primary_upstream_provider',
 __( 'Upstream provider', 'tgwf' ),
 'tgwf_field_upstream_provider_cb',
 'tgwf',
 'tgwf_section_carbon_txt',
 [
 'label_for' => 'tgwf_primary_upstream_provider',
 'class' => 'tgwf_row',
 'tgwf_custom_data' => 'custom',
 ]
 );

 add_settings_field(
  'tgwf_offset_certificate',
  __( 'Offset Certificate', 'tgwf' ),
  'tgwf_field_offset_cert_cb',
  'tgwf',
  'tgwf_section_carbon_txt',
  [
  'label_for' => 'tgwf_field_offset_cert',
  'class' => 'tgwf_row',
  ]
  );

add_settings_field(
  'tgwf_offset_expiry',
  __( 'Offset Certificate Expiry Date', 'tgwf' ),
  'tgwf_field_offset_expiry_date_cb',
  'tgwf',
  'tgwf_section_carbon_txt',
  [
  'label_for' => 'tgwf_field_offset_expiry_date',
  'class' => 'tgwf_row',
  ]
  );


add_settings_field(
  'tgwf_show_carbon_txt',
  __( 'Show carbon.txt', 'tgwf' ),
  'tgwf_field_show_carbon_txt_cb',
  'tgwf',
  'tgwf_section_carbon_txt',
  [
  'label_for' => 'tgwf_field_show_carbon_txt',
  'class' => 'tgwf_row',
  ]
  );
}


/**
 * register our wporg_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wporg_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */

// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function tgwf_section_carbon_txt_cb( $args ) {
 ?>
  <p id="<?php echo esc_attr( $args['id'] ); ?>">
    <?php esc_html_e( 'Carbon.txt is a way to show you run your site on renewable power. Fill in the details below, to generate your carbon.txt file', 'tgwf' ); ?>
  </p>
 <?php
}

// pill field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.

function tgwf_field_upstream_provider_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'tgwf_options' );
 // output the field
 ?>
 <input
  type="text"
  id="<?php echo esc_attr( $args['label_for'] ); ?>"
  name="tgwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
  value="<?php echo isset( $options[ $args['label_for'] ] )
  ?
  ( $options[ $args['label_for']] )
  :
  ( '' ); ?>"
  />

 <p class="description">
 <?php esc_html_e( 'If you run a website this is typically your hosting company. If you run a hosting company, this will often be the people running the datacentre for your servers.' , 'tgwf' ); ?>
 <a href="">See more</a>
 </p>

 <?php
}

function tgwf_field_offset_cert_cb( $args ) {
  // get the value of the setting we've registered with register_setting()
  $options = get_option( 'tgwf_options' );
  // output the field
  ?>
  <input
   type="text"
   id="<?php echo esc_attr( $args['label_for'] ); ?>"
   name="tgwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
   value="<?php echo isset( $options[ $args['label_for'] ] )
   ?
   ( $options[ $args['label_for']] )
   :
   ( '' ); ?>"
   />
   <p class="description">
    <?php esc_html_e( "If you can't use a green provider, the next best thing is to account for the emissions from your site, by offsetting the emissions." , 'tgwf' ); ?>
   </p>
   <?php
}

function tgwf_field_offset_expiry_date_cb( $args ) {
  // get the value of the setting we've registered with register_setting()
  $options = get_option( 'tgwf_options' );
  // output the field
  ?>
  <input
   type="text"
   id="<?php echo esc_attr( $args['label_for'] ); ?>"
   name="tgwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
   value="<?php echo isset( $options[ $args['label_for'] ] )
   ?
   ( $options[ $args['label_for']] )
   :
   ( '' ); ?>"
   />
   <p class="description">
    <?php esc_html_e( "Offsets typically last a year" , 'tgwf' ); ?>
   </p>
   <?php
}

function tgwf_field_show_carbon_txt_cb( $args ) {
  // get the value of the setting we've registered with register_setting()
  $options = get_option( 'tgwf_options' );
  // output the field
  ?>
  <select
    id="<?php echo esc_attr( $args['label_for'] ); ?>"
    name="tgwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
  >
    <option value="yes" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
      <?php esc_html_e( 'yes', 'tgwf' ); ?>
    </option>
    <option value="no" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
      <?php esc_html_e( 'no', 'tgwf' ); ?>
    </option>

  </select>
   <p class="description">
    <?php esc_html_e( "Create a carbon.txt at the root of this site?" , 'tgwf' ); ?>
   </p>
   <?php
}
/**
 * top level menu
 */
function wporg_options_page() {
 // add top level menu page
 add_menu_page(
 'The Green Web Foundation',
 'Green Web',
 'manage_options',
 'tgwf',
 'wporg_options_page_html'
 );
}
 
/**
 * register our wporg_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wporg_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function wporg_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'tgwf' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'wporg_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wporg"
 settings_fields( 'tgwf' );
 // output setting sections and their fields
 // (sections are registered for "wporg", each field is registered to a specific section)
 do_settings_sections( 'tgwf' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}
