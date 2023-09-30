<?php
/**
 * Theme Theme Options.
 *
 * @package md-prime
 */

namespace MD_PRIME\Inc;

use MD_PRIME\Inc\Traits\Singleton;

/**
 * Class Theme Options.
 */
class Theme_Option {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'admin_menu', [ $this, 'add_option_menu' ] );
		add_action( 'admin_init', [ $this, 'option_settings_init' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'theme_option_js' ] );

	}

	/**
	 * Added option Menu.
	 *
	 * @return void
	 */
	public function add_option_menu() {
		add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'md-prime', [ $this, 'option_form' ], '', 50 );
	}

	/**
	 * Generate Option form.
	 * Added enctype="multipart/form-data" to allow media upload.
	 *
	 * @return void
	 */
	public function option_form() {
		?>
		<span><?php settings_errors(); ?></span>
		<form action='options.php' enctype="multipart/form-data" method='post'> 
			<?php
			settings_fields( 'md-prime-setting' );
			do_settings_sections( 'md-prime' );
			submit_button();
			?>
		</form> 
		<?php
	}

	/**
	 * Add Setting fields.
	 *
	 * @return void
	 */
	public function option_settings_init() {
		register_setting( 'md-prime-setting', 'md_prime_settings' );
		add_settings_section( 'md-prime-section', __( 'Theme Options', 'md-prime' ), [ $this, 'theme_option_description' ], 'md-prime' );
		add_settings_field(
			'md_prime_logo',
			__( 'Site Logo:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'file',
				'name'  => 'md_prime_settings[md_prime_img]',
				'value' => 'md_prime_img',
			]
		);
		add_settings_field(
			'md_prime_favicon',
			__( 'Site Favicon:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'file',
				'name'  => 'md_prime_settings[md_prime_favicon]',
				'value' => 'md_prime_favicon',
			]
		);
		add_settings_field(
			'md_prime_tagline',
			__( 'Site Tagline:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'text',
				'name'  => 'md_prime_settings[md_prime_tagline]',
				'value' => 'md_prime_tagline',
			]
		);
		add_settings_field(
			'md_prime_google_analytic',
			__( 'Google Analytic:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'textarea',
				'name'  => 'md_prime_settings[md_prime_google_analytic]',
				'value' => 'md_prime_google_analytic',
			]
		);
		add_settings_field(
			'md_prime_css_code',
			__( 'Additional CSS:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'textarea',
				'name'  => 'md_prime_settings[md_prime_css_code]',
				'value' => 'md_prime_css_code',
			]
		);
		add_settings_field(
			'md_prime_html_code',
			__( 'Additional html:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'textarea',
				'name'  => 'md_prime_settings[md_prime_html_code]',
				'value' => 'md_prime_html_code',
			]
		);
		add_settings_field(
			'md_prime_color_picker',
			__( 'Color:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'color-picker',
				'name'  => 'md_prime_settings[md_prime_color_picker]',
				'value' => 'md_prime_color_picker',
			]
		);
		add_settings_field(
			'md_prime_select_color_picker',
			__( 'Select Color:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'color-picker',
				'name'  => 'md_prime_settings[md_prime_select_color_picker]',
				'value' => 'md_prime_select_color_picker',
			]
		);
		add_settings_field(
			'md_prime_wysiwyg',
			__( 'Text Editor:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'wysiwyg',
				'name'  => 'md_prime_settings[md_prime_wysiwyg]',
				'value' => 'md_prime_wysiwyg',
			]
		);
		add_settings_field(
			'md_prime_password',
			__( 'Manage Password:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'password',
				'name'  => 'md_prime_settings[md_prime_password]',
				'id'    => 'psw',
				'value' => 'md_prime_password',
			]
		);
		add_settings_field(
			'md_prime_selectbox',
			__( 'Select Option:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'    => 'select',
				'name'    => 'md_prime_settings[md_prime_selectbox]',
				'value'   => 'md_prime_selectbox',
				'options' => [
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
				],
			]
		);
		add_settings_field(
			'md_prime_multiselect',
			__( 'Select Multiple Option:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'    => 'multicheck',
				'name'    => 'md_prime_settings[md_prime_multiselect]',
				'id'      => 'chkveg',
				'value'   => 'md_prime_multiselect',
				'options' => [
					'0' => 'pizza',
					'1' => 'biryani',
					'2' => 'burger',
					'3' => 'pav bhaji',
				],
			]
		);
		add_settings_field(
			'md_prime_radio',
			__( 'Select Radio Option:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'    => 'radio',
				'name'    => 'md_prime_settings[md_prime_radio]',
				'value'   => 'md_prime_radio',
				'options' => [
					'0' => 'HTML',
					'1' => 'CSS',
					'2' => 'JS',
					'3' => 'PHP',
				],
			]
		);
		add_settings_field(
			'md_prime_checkbox',
			__( 'Select Checkbox Option:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'checkbox',
				'name'  => 'md_prime_settings[md_prime_checkbox]',
				'id'    => 'check',
				'value' => 'md_prime_checkbox',
				'task'  => 'Enable Transparent Header ?',
			]
		);
		add_settings_field(
			'md_prime_number',
			__( 'Number:', 'md-prime' ),
			[ $this, 'add_field' ],
			'md-prime',
			'md-prime-section',
			[
				'type'  => 'number',
				'name'  => 'md_prime_settings[md_prime_number]',
				'value' => 'md_prime_number',
			]
		);

	}

	/**
	 * Callback to display description.
	 *
	 * @return void
	 */
	public function theme_option_description() {
		echo esc_html__( 'Update Settings.', 'md-prime' );
	}

	/**
	 * Generate Fields.
	 *
	 * @param  array $args Field argument.
	 * @return void
	 */
	public function add_field( array $args ) {
		$options = get_option( 'md_prime_settings' );
		switch ( $args['type'] ) {
			case 'text':
				$this->text_callback( $args, $options );
				break;
			case 'textarea':
				$this->textarea_callback( $args, $options );
				break;
			case 'file':
				$this->file_callback( $args, $options );
				break;
			case 'checkbox':
				$this->checkbox_callback( $args, $options );
				break;
			case 'multicheck':
				$this->multiselect_callback( $args, $options );
				break;
			case 'color-picker':
				$this->color_picker_callback( $args, $options );
				break;
			case 'wysiwyg':
				$this->wysiwyg_callback( $args, $options );
				break;
			case 'password':
				$this->password_callback( $args, $options );
				break;
			case 'select':
				$this->selectbox_callback( $args, $options );
				break;
			case 'radio':
				$this->radio_button_callback( $args, $options );
				break;
			case 'number':
				$this->number_callback( $args, $options );
				break;
		}
	}

	/**
	 * Generate textbox.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function text_callback( $args, $options ) {
		?>
		<input type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" />
		<?php
	}

	/**
	 * Generate textarea.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function textarea_callback( $args, $options ) {
		?>
		<textarea type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" rows="8" cols="40"><?php echo isset( $options[ $args['value'] ] ) ? esc_html( $options[ $args['value'] ] ) : ''; ?></textarea>
		<?php
	}

	/**
	 * Generate image.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function file_callback( $args, $options ) {
		?>
		<img class="md_prime_img" name="<?php echo esc_attr( $args['name'] ); ?>" src="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" <?php
		if ( ! empty( $options[ $args['value'] ] ) ) {
			echo 'width="250px" height="150px"';
		}
		?>/>
		<input class="md_prime_img_url" type="hidden" name="<?php echo esc_attr( $args['name'] ); ?>" size="60" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
		<a href="#" class="md_prime_img_upload"><button>Upload</button></a>
		<a href="#" class="md_prime_img_remove"><button>Remove</button></a>
		<?php
	}

	/**
	 * Generate Checkbox.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function checkbox_callback( $args, $options ) {
		?>
		<input id="<?php echo esc_attr( $args['id'] ); ?>" type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="true" <?php checked( 'true', $options[ $args['value'] ] ); ?>>
		<label for="<?php echo esc_attr( $args['id'] ); ?>"><?php echo esc_html( $args['task'] ); ?></label>
		<?php
	}

	/**
	 * Generate Multi Select.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function multiselect_callback( $args, $options ) {
		$multi_select_options = $args['options'];
		?>
		<select multiple id="<?php echo esc_attr( $args['id'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>[]" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
			<?php
			foreach ( $multi_select_options as $key => $value ) :
				?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php if(isset( $options[ $args['value'] ] )) { echo in_array( "$key", $options[ $args['value'] ], true ) ? 'selected' : ''; } ?>><?php echo esc_html( $value );  ?></option>
				<?php
				endforeach;
			?>
		</select>
		<br />
		<span id="help-notice">hold command on MAC and control on Windows to select multiple options</span>
		<?php
	}

	/**
	 * Generate Color Picker.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function color_picker_callback( $args, $options ) {
		?>
		<input type="text" class="color-picker" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" />
		<?php
	}

	/**
	 * Generate wysiwyg.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function wysiwyg_callback( $args, $options ) {
		$content = isset( $options[ $args['value'] ] ) ? $options[ $args['value'] ] : '';
		wp_editor( $content, 'wysiwyg', [ 'textarea_name' => esc_attr( $args['name'] ) ] );
	}


	/**
	 * Generate Password.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function password_callback( $args, $options ) {
		?>
		<input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="<?php echo esc_attr($args['id']) ?>" type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" />
		<div id="message">
			<h3>Password must contain the following:</h3>
			<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
			<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
			<p id="number" class="invalid">A <b>number</b></p>
			<p id="length" class="invalid">Minimum <b>8 characters</b></p>
		</div>
		<?php
	}

	/**
	 * Generate Select Box.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function selectbox_callback( $args, $options ) {
		$select_options = $args['options'];
		?>
		<select name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
			<?php
			foreach ( $select_options as $key => $value ) :
				?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $options[ $args['value'] ], $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php
				endforeach;
			?>
		</select>
		<?php
	}

	/**
	 * Generate Radio Button.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function radio_button_callback( $args, $options ) {
		$radio_options = $args['options'];
		foreach ( $radio_options as $key => $value ) :
			?>
			<input id="val<?php echo esc_attr( $key ) ?>" type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $options[ $args['value'] ], $key ); ?>>
			<label for="val<?php echo esc_attr( $key ) ?>"><?php echo esc_html( $value ); ?></label><br>
			<?php
		endforeach;
	}

	/**
	 * Generate Number Textbox.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 */
	public function number_callback( $args, $options ) {
		?>
		<input type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
		<?php
	}

	/**
	 * Enqueue option js file.
	 *
	 * @return void
	 */
	public function theme_option_js() {

		wp_enqueue_style( 'wp-color-picker' );

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_register_script( 'theme-option-js', MD_PRIME_BUILD_JS_URI . '/themeoption.js', [ 'jquery', 'wp-color-picker' ], filemtime( MD_PRIME_BUILD_JS_DIR_PATH . '/themeoption.js' ), true );
		wp_enqueue_script( 'theme-option-js' );
	}

}
