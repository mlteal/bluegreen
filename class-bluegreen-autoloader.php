<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bluegreen_Autoloader {
	/**
	 * The slug used for the collection.
	 *
	 * This is the folder that we will look in, and also the base namespace used.
	 *
	 * @var string
	 */
	protected static $collection = 'bluegreen';

	/**
	 * Path to the includes directory.
	 *
	 * @var string
	 */
	private $include_path = '';

	/**
	 * Handle a filename prefix to follow WP code standard
	 *
	 * @var string
	 */
	private static $filename_prefix = 'class-';

	/**
	 * The Constructor.
	 */
	public function __construct() {
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		/**
		 * Load everything in the collection's folder
		 *
		 */
		$this->include_path = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/' . static::$collection . '/';
	}

	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class
	 *
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		$class = strtolower( $class );

		/**
		 * If this is a namespaced class, make sure we properly pull the filename.
		 *
		 * TODO: we may need to reevaluate this renaming func as
		 * I don't think it'll work on windows environments...
		 */
		if ( stristr( $class, '\\' ) ) {
			// string replace the double slashes first
			$class = str_replace( array( '_', '\\' ), array( '-', '/' ), $class );

			$class = explode( '/', $class );

			// if the first item is == the collection name, trim it off
			if ( ! empty( $class[0] ) && static::$collection === $class[0] ) {
				unset( $class[0] );
			}

			// Capture the last array item key and  add the 'class-' and '.php' bits. http://php.net/manual/en/function.end.php
			end( $class );
			$last_key = key( $class );
			reset( $class );

			$class[ $last_key ] = static::$filename_prefix . $class[ $last_key ] . '.php';

			// Use the `join()` function & magic constant to correctly put the filepath together
			$filepath = join( DIRECTORY_SEPARATOR, $class );

			return $filepath;
		} else {
			return static::$filename_prefix . str_replace( '_', '-', $class ) . '.php';
		}
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path
	 *
	 * @return bool successful or not
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once( $path );

			return true;
		}

		return false;
	}

	/**
	 * Auto-load classes on demand to reduce memory consumption.
	 *
	 * @param string $class
	 */
	public function autoload( $class ) {
		$file = $this->get_file_name_from_class( $class );

		$this->load_file( $this->include_path . $file );
	}
}

new Bluegreen_Autoloader();
