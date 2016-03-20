<?php
/**
 * Track Paid Members Pro destination tests
 *
 * @package   ingot-pmpro-lib
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock for Ingot LLC
 */

namespace ingot\addon\pmpro;


use ingot\testing\tests\click\destination\hooks;

class tracking {

	/**
	 * Add the tracking hooks
	 *
	 * @since 1.1.0
	 */
	public function __construct(){
		add_action( 'template_redirect', [ $this, 'track' ] );
	}

	/**
	 * Track conversions when EDD product added to cart
	 *
	 * @since 1.1.0
	 *
	 * @uses "edd_post_add_to_cart"
	 */
	public function template_redirect(){

		global $pmpro_pages, $pmpro_level;

		$track = false;
		if(is_page($pmpro_pages['levels'])) {
			//on the pricing/levels page
			$track = 'pmpro_levels';
		}

		if(is_page($pmpro_pages['checkout'])) {
			$track = 'pmpro_checkout';
		}

		/**
		if(is_page($pmpro_pages['checkout']) && $pmpro_level->id == $level_id) {
			//on a specific levels' checkout page
		}

		 if(is_page($pmpro_pages['confirmation']) && !empty($_REQUEST['level']) && $_REQUEST['level'] == $level_id) {
		//on the confirmation page for a specific level
		}
**/
		if(is_page($pmpro_pages['confirmation'])) {
			$tracking = 'pmpro_confirmation';
		}


		if ( $tracking  ) {
			hooks::get_instance( [ ] )->check_if_victory( $tracking );
		}

	}



}
