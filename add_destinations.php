<?php
/**
 * Add EDD conversion destination tracking
 *
 * @package   ingot-edd-lib
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock for Ingot LLC
 */


namespace ingot\addon\pmpro;

class add_destinations {
	/**
	 * Add hooks
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'ingot_allowed_destination_types', [ $this, 'destination_types' ] );
		add_filter( 'ingot_allowed_click_types', [ $this, 'allow_destination' ] );
	}

	/**
	 * Add EDD type destination tests
	 *
	 * @since 1.0.0
	 *
	 * @uses "ingot_allowed_click_types" filter
	 *
	 * @param $types
	 *
	 * @return array
	 */
	public function destination_types( $types ){
		return array_merge( $types, [
				'pmpro_levels' => [
					'name'        => __( 'Levels Page -- Paid Members Pro', 'ingot' ),
					'description' => __( 'Conversion is registered when an item is added to the Easy Digital Downloads cart.', 'ingot' ),
				],
				'pmpro_checkout' => [
					'name'        => __( 'Checkout Page -- Paid Members Pro', 'ingot' ),
					'description' => __( 'Conversion is registered when an Easy Digital Downloads sale is completed.', 'ingot' ),
				],
				'pmpro_joined' => [
					'name'        => __( 'Checkout Page -- Paid Members Pro', 'ingot' ),
					'description' => __( 'Conversion is registered when an Easy Digital Downloads sale is completed.', 'ingot' ),
				],
			]
		);

	}

	/**
	 * Add destination testing if not already added
	 *
	 * @since 1.0.0
	 *
	 * @uses "ingot_allowed_click_types" filter
	 *
	 * @param $types
	 *
	 * @return array
	 */
	public function allow_destination( $types ){
		if( ! isset( $types[ 'destination' ] ) ){
			$types = array_merge( $types, \ingot\testing\types::destination_definition() );
		}

		return $types;
	}

}
