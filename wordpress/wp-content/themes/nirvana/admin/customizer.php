<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @since Nirvana 0.9.9
 */

function nirvana_customizer_setup($wp_customize) {
	class Nirvana_Extended_Settings extends WP_Customize_Control {
		public $type = 'nirvana_extended_link';
		public function render_content() {
			_e(
				sprintf('To configure the remaining 200+ theme options, access the dedicated %s page.',
						'<b><a href="themes.php?page=nirvana-page">'.
							__('Nirvana Settings','nirvana').
						'</a></b>'),
						'nirvana'
			);
		}
	}  // class
} // nirvana_customizer_setup()

function nirvana_generic_customizer_sanitize(){
	// dummy function that does nothing, since the sanitizer add_section function 
	// does not add any user-editable field
}
 
class Nirvana_Customize {

   public static function register ( $wp_customize ) {
   
      $wp_customize->add_section( 'nirvana_settings', 
         array(
            'title' => __( 'Nirvana Advanced Settings', 'nirvana' ), //Visible title of section
            'priority' => 999, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __(' ', 'nirvana'), //Descriptive tooltip
         ) 
      );
        
      $wp_customize->add_setting( 'nirvana_extended_link', 
         array(
            'default' => '#', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'nirvana_generic_customizer_sanitize', //Sanitizer function callback
         ) 
      ); 	  

	  $wp_customize->add_control( new Nirvana_Extended_Settings( 
		$wp_customize, 
		'nirvana_extended_link', 
		array(
			'label'   => '',
			'section' => 'nirvana_settings',
			'settings'   => 'nirvana_extended_link',
		)
	  ) );
   
   }
 
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', 'nirvana_customizer_setup' );
add_action( 'customize_register' , array( 'Nirvana_Customize' , 'register' ) );

?>