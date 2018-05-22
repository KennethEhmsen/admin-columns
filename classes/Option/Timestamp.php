<?php

namespace AC\Option;

use AC\Expirable;
use AC\Option;

class Timestamp extends Option
	implements Expirable {

	/**
	 * @param int|null $time
	 *
	 * @return bool
	 */
	public function is_expired( $time = null ) {
		$value = $this->get();

		if ( false === $value ) {
			return true;
		}

		if ( null === $time ) {
			$time = time();
		}

		return $time > $value;
	}

	/**
	 * @param int $value
	 *
	 * @return bool
	 */
	public function validate( $value ) {
		return preg_match( '/^[1-9][0-9]*$/', $value );
	}

	/**
	 * @param int $value
	 *
	 * @return bool
	 */
	public function save( $value ) {
		if ( ! $this->validate( $value ) ) {
			throw new \Exception( 'Value needs to be a positive integer' );
		}

		return parent::save( $value );
	}

}