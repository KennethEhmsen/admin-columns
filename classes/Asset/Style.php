<?php

namespace AC\Asset;

final class Style
	implements Enqueueable {

	/**
	 * Handle of the script asset.
	 *
	 * @var string
	 */
	private $handle;

	/**
	 * Location of the script asset.
	 *
	 * @var Location
	 */
	private $location;

	/**
	 * Array of handles that the script asset depends on.
	 *
	 * @var array<string>
	 */
	private $dependencies;

	/**
	 *
	 * @param string   $handle       Handle of the script asset.
	 * @param Location $location     Location of the script asset.
	 * @param array    $dependencies Optional. Array of handles that the script
	 *                               asset depends on. Defaults to an empty
	 *                               array.
	 */
	public function __construct( $handle, Location $location, array $dependencies = array() ) {
		$this->handle = $handle;
		$this->location = $location;
		$this->dependencies = $dependencies;
	}

	/**
	 * Get the handle that is being used for enqueueing.
	 *
	 * @return string Handle under which to enqueue.
	 */
	public function get_handle() {
		return $this->handle;
	}

	/**
	 * Get the location of the script asset.
	 *
	 * @return Location Location of the file that represents the script asset.
	 */
	private function get_location() {
		return $this->location;
	}

	/**
	 * Get the dependencies of the script asset.
	 *
	 * @return array Array of handles that the script depends on.
	 */
	private function get_dependencies() {
		return $this->dependencies;
	}

	/**
	 * Register an enqueueable object.
	 *
	 * @return void
	 */
	public function register() {
		wp_register_script(
			$this->get_handle(),
			$this->get_location()->get_url(),
			$this->get_dependencies(),
			filemtime( $this->get_location()->get_path() )
		);
	}

	/**
	 * Enqueue an enqueueable object.
	 *
	 * @return void
	 */
	public function enqueue() {
		if ( wp_script_is( $this->get_handle(), 'enqueued' ) ) {
			return;
		}

		if ( ! wp_script_is( $this->get_handle(), 'registered' ) ) {
			$this->register();
		}

		wp_enqueue_style( $this->get_handle() );
	}
}
