<?php
/**
 *  Load All Core Initialisation class
 *  @package Core
 *  @author Flipper Code <hello@flippercode.com>
 */

if ( ! class_exists( 'FlipperCode_Initialise_Core' ) ) {


	 class FlipperCode_Initialise_Core {

		public function __construct() {	$this->_load_core_files(); }

		public function _load_core_files() {

			$corePath  = plugin_dir_path( __FILE__ );
			$coreFiles = array(
				'class.tabular.php',
				'class.template.php',
				'abstract.factory.php',
				'class.controller-factory.php',
				'class.model-factory.php',
				'class.controller.php',
				'class.model.php',
				'class.validation.php',
				'class.database.php',
				'class.importer.php',
				'class.plugin-overview.php',
			);

			/**
			 *  Load All Core Initialisation class from core folder
			 */
			foreach ( $coreFiles as $file ) {

				if ( file_exists( $corePath.$file ) ) {
					require_once( $corePath.$file );
				}
			}


		}

	 }

}
return new FlipperCode_Initialise_Core();
