<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AC_Helper_FormElement_Input extends AC_Helper_FormElement {

	protected $type;

	public function __construct() {
		parent::__construct();

		$this->set_type( 'text' );
	}

	public function get_type() {
		return $this->type;
	}

	/**
	 * @param string $type
	 *
	 * @return $this
	 */
	public function set_type( $type ) {
		$this->type = $type;

		return $this;
	}

	public function display() {
		$attributes = array();

		foreach ( $this->get_attributes() as $key => $value ) {
			$attributes[] = $this->attribute( $key, true );
		}

		?>

		<input <?php echo implode( ' ', $attributes ); ?>>

		<?php
	}

}