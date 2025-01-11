<?php
/**
 * Theme Options.
 *
 * @package theme-options
 */

/**
 * Class Theme Options Initialization.
 */
class Theme_Option {

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
		add_action( 'admin_menu', array( $this, 'add_option_menu' ) );
		add_action( 'admin_init', array( $this, 'option_settings_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'theme_option_js' ) );

	}

	/**
	 * Added option Menu.
	 *
	 * @return void
	 */
	public function add_option_menu() {
		add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'theme-option', array( $this, 'option_form' ), '', 50 );
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
			settings_fields( 'theme-option-setting' );
			do_settings_sections( 'theme-option' );
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
		register_setting( 'theme-option-setting', 'theme_option_settings' );
		add_settings_section( 'theme-option-section', __( 'Theme Options', 'theme-option' ), array( $this, 'theme_option_description' ), 'theme-option' );
		add_settings_field(
			'theme_option_logo',
			__( 'Site Logo:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'file',
				'name'  => 'theme_option_settings[theme_option_img]',
				'value' => 'theme_option_img',
			)
		);
		add_settings_field(
			'theme_option_favicon',
			__( 'Site Favicon:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'file',
				'name'  => 'theme_option_settings[theme_option_favicon]',
				'value' => 'theme_option_favicon',
			)
		);
		add_settings_field(
			'theme_option_tagline',
			__( 'Site Tagline:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'text',
				'name'  => 'theme_option_settings[theme_option_tagline]',
				'value' => 'theme_option_tagline',
			)
		);
		add_settings_field(
			'theme_option_google_analytic',
			__( 'Google Analytic:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'textarea',
				'name'  => 'theme_option_settings[theme_option_google_analytic]',
				'value' => 'theme_option_google_analytic',
			)
		);
		add_settings_field(
			'theme_option_css_code',
			__( 'Additional CSS:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'textarea',
				'name'  => 'theme_option_settings[theme_option_css_code]',
				'value' => 'theme_option_css_code',
			)
		);
		add_settings_field(
			'theme_option_html_code',
			__( 'Additional html:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'textarea',
				'name'  => 'theme_option_settings[theme_option_html_code]',
				'value' => 'theme_option_html_code',
			)
		);
		add_settings_field(
			'theme_option_color_picker',
			__( 'Color:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'color-picker',
				'name'  => 'theme_option_settings[theme_option_color_picker]',
				'value' => 'theme_option_color_picker',
			)
		);
		add_settings_field(
			'theme_option_select_color_picker',
			__( 'Select Color:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'color-picker',
				'name'  => 'theme_option_settings[theme_option_select_color_picker]',
				'value' => 'theme_option_select_color_picker',
			)
		);
		add_settings_field(
			'theme_option_wysiwyg',
			__( 'Text Editor:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'wysiwyg',
				'name'  => 'theme_option_settings[theme_option_wysiwyg]',
				'value' => 'theme_option_wysiwyg',
			)
		);
		add_settings_field(
			'theme_option_password',
			__( 'Manage Password:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'password',
				'name'  => 'theme_option_settings[theme_option_password]',
				'id'    => 'psw',
				'value' => 'theme_option_password',
			)
		);
		add_settings_field(
			'theme_option_selectbox',
			__( 'Select Option:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'    => 'select',
				'name'    => 'theme_option_settings[theme_option_selectbox]',
				'value'   => 'theme_option_selectbox',
				'options' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
				),
			)
		);
		add_settings_field(
			'theme_option_multiselect',
			__( 'Select Multiple Option:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'    => 'multicheck',
				'name'    => 'theme_option_settings[theme_option_multiselect]',
				'id'      => 'chkveg',
				'value'   => 'theme_option_multiselect',
				'options' => array(
					'0' => 'pizza',
					'1' => 'biryani',
					'2' => 'burger',
					'3' => 'pav bhaji',
				),
			)
		);
		add_settings_field(
			'theme_option_radio',
			__( 'Select Radio Option:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'    => 'radio',
				'name'    => 'theme_option_settings[theme_option_radio]',
				'value'   => 'theme_option_radio',
				'options' => array(
					'0' => 'HTML',
					'1' => 'CSS',
					'2' => 'JS',
					'3' => 'PHP',
				),
			)
		);
		add_settings_field(
			'theme_option_checkbox',
			__( 'Select Checkbox Option:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'checkbox',
				'name'  => 'theme_option_settings[theme_option_checkbox]',
				'id'    => 'check',
				'value' => 'theme_option_checkbox',
				'task'  => 'Enable Transparent Header ?',
			)
		);
		add_settings_field(
			'theme_option_number',
			__( 'Number:', 'theme-option' ),
			array( $this, 'add_field' ),
			'theme-option',
			'theme-option-section',
			array(
				'type'  => 'number',
				'name'  => 'theme_option_settings[theme_option_number]',
				'value' => 'theme_option_number',
			)
		);

	}

	/**
	 * Callback to display description.
	 *
	 * @return void
	 */
	public function theme_option_description() {
		echo esc_html__( 'Update Settings.', 'theme-option' );
	}

	/**
	 * Generate Fields.
	 *
	 * @param  array $args Field argument.
	 * @return void
	 */
	public function add_field( array $args ) {
		$options = get_option( 'theme_option_settings' );
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
		<img class="theme_option_img" name="<?php echo esc_attr( $args['name'] ); ?>" src="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" 
			<?php
			if ( ! empty( $options[ $args['value'] ] ) ) {
				echo 'width="250px" height="150px"';
			}
			?>
		/>
		<input class="theme_option_img_url" type="hidden" name="<?php echo esc_attr( $args['name'] ); ?>" size="60" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
		<a href="#" class="theme_option_img_upload"><button>Upload</button></a>
		<a href="#" class="theme_option_img_remove"><button>Remove</button></a>
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
				<option value="<?php echo esc_attr( $key ); ?>" 
					<?php 
					if ( isset( $options[ $args['value'] ] ) ) {
						echo in_array( "$key", $options[ $args['value'] ], true ) ? 'selected' : ''; } 
					?>
				><?php echo esc_html( $value ); ?></option>
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
		wp_editor( $content, 'wysiwyg', array( 'textarea_name' => esc_attr( $args['name'] ) ) );
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
		<input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="<?php echo esc_attr( $args['id'] ); ?>" type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" />
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
			<input id="val<?php echo esc_attr( $key ); ?>" type="<?php echo esc_attr( $args['type'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $options[ $args['value'] ], $key ); ?>>
			<label for="val<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></label><br>
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

		wp_register_script( 'theme-option-js', get_template_directory_uri() . '/themeoption.js', array( 'jquery', 'wp-color-picker' ), filemtime( get_template_directory_uri() . '/themeoption.js' ), true );
		wp_enqueue_script( 'theme-option-js' );
	}

}
