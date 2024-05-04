<?php
/*
 * Template Name: Status
*/
$companyColor = get_option( 'color' );
?>


<?php get_header( 'minimal' ); ?>

<section class="content">
	<div class="container text-center">
		<div class="col-12 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6">
			<div class="status">
				<?php
				$orderID = get_request_parameter( 'order-id' );
				$order   = get_post( $orderID );
				$notes = getCustomerNotes( $order->ID );

				if ( empty( $order ) ) {
					include template( 'front-pages/no-order' );
				} else {
					include template( 'front-pages/order-status' );
				}
				?>
			</div>
		</div>
	</div>
</section>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/swb/css/sass/order-status.css">

<style>
	.order-status-step__active,
    .further-info {
		background: <?php echo $companyColor;?>;
	}
</style>

<?php get_footer( 'minimal' ); ?>

