<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AC_Settings_View_Width extends AC_Settings_ViewAbstract {

	public function __construct( AC_Column $column ) {
		parent::__construct( $column );

		$this->set_label( __( 'Width', 'codepress-admin-columns' ) );
	}

	public function render() {
		// todo: these things are stored as two values, but why? Is the rationale behind 1 input weird?
	}

	public function get_value() {
		return $this->get_width() . $this->get_width_unit();
	}

	/**
	 * HTML
	 */
	public function display() {
		$this->field( array(
			'type'  => 'html',
			'name'  => 'width',
			'label' => __( 'Width', 'codepress-admin-columns' ),
			'html'  => $this->width_field(),
		) );
	}

	/**
	 * @since NEWVERSION
	 *
	 * @return string px or %
	 */
	public function get_width_unit() {
		$width_unit = $this->settings->get_option( 'width_unit' );

		if ( ! $width_unit ) {
			$width_unit = $this->get_default_with_unit();
		}

		return 'px' === $width_unit ? 'px' : '%';
	}

	/**
	 * Get default with unit
	 *
	 * @return string
	 */
	public function get_default_with_unit() {
		return '%';
	}

	/**
	 * @since NEWVERSION
	 * @return int Width
	 */
	public function get_width() {
		$width = absint( $this->settings->get_option( 'width' ) );

		if ( ! $width ) {
			$width = $this->get_default_with();
		}

		return $width > 0 ? $width : false;
	}

	/**
	 * Get default with unit
	 *
	 * @return string
	 */
	public function get_default_with() {
		return false;
	}

	/**
	 * @return string HTML
	 */
	private function width_field() {
		ob_start();
		?>
		<div class="description" title="<?php echo esc_attr( __( 'default', 'codepress-admin-columns' ) ); ?>">
			<input class="width" type="text" placeholder="<?php echo esc_attr( __( 'auto', 'codepress-admin-columns' ) ); ?>" name="<?php $this->attr_name( 'width' ); ?>" id="<?php $this->attr_id( 'width' ); ?>" value="<?php echo esc_attr( $this->get_width() ); ?>"/>
			<span class="unit"><?php echo esc_html( $this->get_width_unit() ); ?></span>
		</div>
		<div class="width-slider"></div>

		<div class="unit-select">
			<?php
			ac_helper()->formfield->radio( array(
				'attr_id'       => $this->get_attr_id( 'width_unit' ),
				'attr_name'     => $this->get_attr_name( 'width_unit' ),
				'options'       => array(
					'px' => 'px',
					'%'  => '%',
				),
				'class'         => 'unit',
				'default_value' => $this->get_width_unit(),
			) );
			?>
		</div>
		<?php

		return ob_get_clean();
	}

}