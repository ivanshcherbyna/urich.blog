<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_Lwp_config' ) ) {

	class Redux_Framework_Lwp_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			// add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		/**
		 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
		 * */
		function change_arguments( $args ) {
			//$args['dev_mode'] = true;

			return $args;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::instance(),
					'plugin_metalinks'
				), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}

		public function setSections() {

			/* Set fields */
            $header_fields = array(
                array(
                    'title' => __('Логотип', THEME_OPT),
                    'type' => 'media',
                    'id' =>'logo-header-img'
                ),
                array(
                    'id'             => 'menu-repeater-items',
                    'type'           => 'repeatable_list',
                    'accordion'      => true,
                    'title'          => __('Меню:', THEME_OPT),
                    'add_button'     => __( 'Добавить пункт', THEME_OPT),
                    'remove_button'  => __( 'Удалить пункт', THEME_OPT),
                    'fields'         => array(
                        array(
                            'id'       => 'menu-title',
                            'type'     => 'text',
                            'title'    => __('Название раздела', THEME_OPT),
                        ),
                        array(
                            'id'       => 'menu-link',
                            'type'     => 'text',
                            'title'    => __('URL раздела', THEME_OPT),
                        ),
                    )
                )
            );

			$footer_fields = array(
                array(
                    'id' => '1-section-start',
                    'type' => 'section',
                    'subtitle' => __('Левый блок', THEME_OPT),
                    'indent' => true
                ),
                array(
                    'title' => __('Заглавие блока', THEME_OPT),
                    'type' => 'text',
                    'id' =>'text-head-left'
                ),
                array(
                    'title' => __('Текст в подвале слева', THEME_OPT),
                    'id' =>'footer-text-left',
                    'type' => 'editor',
                ),
                array(
                    'title' => __('Контактный телефон', THEME_OPT),
                    'type' => 'text',
                    'id' =>'text-phone-num'
                ),
                array(
                    'title' => __('Контактный е-мейл', THEME_OPT),
                    'type' => 'text',
                    'id' =>'text-email'
                ),
                array(
                    'id'     => 'section-end',
                    'type'   => 'section',
                    'indent' => false,
                ),
                ///////--------------------------//////////
                array(
                    'id' => '2-section-start',
                    'type' => 'section',
                    'subtitle' => __('Правый блок', THEME_OPT),
                    'indent' => true
                ),
                array(
                    'title' => __('Заглавие блока', THEME_OPT),
                    'type' => 'text',
                    'id' =>'text-head-right'
                ),
                array(
                    'title' => __('Текст в подвале слева', THEME_OPT),
                    'id' =>'footer-text-right',
                    'type' => 'editor',
                ),
                array(
                    'title'=>__('Соц сети для подвала', THEME_OPT ),
                    'id' => 'footer-slides-list',
                    'type' => 'slides',
                    'subtitle'    => __( 'Загрузите', THEME_OPT ),
                    'placeholder' => array(
                        'title'       => __( 'title', THEME_OPT ),
                        'description' => __( 'description', 'mytheme' ),
                        'url'         => __( 'ссылка URL', THEME_OPT ),
                    )
                ),
                array(
                    'id'     => 'section-end',
                    'type'   => 'section',
                    'indent' => false,
                ),

			);

            $page404_fields = array(
                array(
                    'title' => __('404 картинка', THEME_OPT),
                    'type' => 'media',
                    'id' =>'404-img'
                ),
                array(
                    'title' => __('енот', THEME_OPT),
                    'type' => 'media',
                    'id' =>'raccoon-img'
                ),
            );

            $contact_form_fields = array(
                array(
                    'title' => __('Картинка', THEME_OPT),
                    'type' => 'media',
                    'id' =>'contact-form-img'
				),
				array(
					'id'     => 'contact-shortcode',
					'type'   => 'text',
					'description'  => __( 'Шорткод контакт формы',THEME_OPT)
				)
		);
			$search_form_fields = array(
							array(
								'title' => __('Картинка', THEME_OPT),
								'type' => 'media',
								'id' =>'raccoon-seacrh'
							)
					);
            /* Set sections */
            $this->sections[] = array(
                'title'  => __( 'Шапка сайта', THEME_OPT ),
                'icon'   => 'el-icon-hand-up',
                'fields' => $header_fields
            );
            $this->sections[] = array(
                'title'  => __( 'Подвал сайта', THEME_OPT ),
                'icon'   => 'el-icon-hand-down',
                'fields' => $footer_fields
            );
            $this->sections[] = array(
                'title'  => __( 'страница 404', THEME_OPT ),
                'icon'   => 'el-icon-error',
                'fields' => $page404_fields
            );
            $this->sections[] = array(
                'title'  => __( 'Контактная форма', THEME_OPT ),
                'icon'   => 'el-icon-envelope',
                'fields' => $contact_form_fields
            );
			$this->sections[] = array(
							'title'  => __( 'Страница поиска', THEME_OPT ),
							'icon'   => 'el-icon-envelope',
							'fields' => $search_form_fields
						);

		}


		/**
		 * All the possible arguments for Redux.
		 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'             => THEME_OPT,
				// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'         => $theme->get( 'Name' ),
				// Name that appears at the top of your panel
				'display_version'      => $theme->get( 'Version' ),
				// Version that appears at the top of your panel
				'menu_type'            => 'menu',
				//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'       => true,
				// Show the sections below the admin menu item or not
				'menu_title'           => __( 'Theme settings', THEME_OPT ),
				'page_title'           => __( 'Theme settings', THEME_OPT ),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'       => '',
				// Set it you want google fonts to update weekly. A google_api_key value is required.
				'google_update_weekly' => false,
				// Must be defined to add google fonts to the typography module
				'async_typography'     => true,
				// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
				'admin_bar'            => true,
				// Show the panel pages on the admin bar
				'admin_bar_icon'     => 'dashicons-portfolio',
				// Choose an icon for the admin bar menu
				'admin_bar_priority' => 50,
				// Choose an priority for the admin bar menu
				'global_variable'      => '',
				// Set a different name for your global variable other than the opt_name
				'dev_mode'             => false,
				// Show the time the page took to load, etc
				'update_notice'        => false,
				// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
				'customizer'           => true,
				// Enable basic customizer support
				//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'        => null,
				// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'          => 'themes.php',
				// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'     => 'manage_options',
				// Permissions needed to access the options panel.
				'menu_icon'            => '',
				// Specify a custom URL to an icon
				'last_tab'             => '',
				// Force your panel to always open to a specific tab (by id)
				'page_icon'            => 'icon-themes',
				// Icon displayed in the admin panel next to your menu_title
				'page_slug'            => 'theme_options',
				// Page slug used to denote the panel
				'save_defaults'        => true,
				// On load save the defaults to DB before user clicks save or not
				'default_show'         => false,
				// If true, shows the default value next to each field that is not the default value.
				'default_mark'         => '',
				// What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'   => false,
				// Shows the Import/Export panel when not used as a field.
				'hide_reset'		   => true,
				// CAREFUL -> These options are for advanced use only
				'transient_time'       => 60 * MINUTE_IN_SECONDS,
				'output'               => true,
				// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'           => true,
				// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				'footer_credit'        => '',

				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'             => '',
				// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'          => false,
				// REMOVE

				// HINTS
				'hints'                => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				)
			);



			// Panel Intro text -> before the form
			$this->args['intro_text'] = __( '<p>Theme options</p>', THEME_OPT );
		}

		public function validate_callback_function( $field, $value, $existing_value ) {
			$error = true;
			$value = 'just testing';

			$return['value'] = $value;
			$field['msg']    = 'your custom error message';
			if ( $error == true ) {
				$return['error'] = $field;
			}

			return $return;
		}

		public function class_field_callback( $field, $value ) {
			print_r( $field );
			echo '<br/>CLASS CALLBACK';
			print_r( $value );
		}

	}

	global $reduxConfig;
	$reduxConfig = new Redux_Framework_Lwp_config();
} else {
	echo "The class has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}
