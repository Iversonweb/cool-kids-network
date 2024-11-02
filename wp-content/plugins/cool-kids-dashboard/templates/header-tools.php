<div class="wp-block-cool-kids-dashboard-header-tools">
	<?php if ( $atts['showAuth'] ) { ?>
		<?php if ( $is_logged_in ) { ?>
			<a class="logout-link signin-link" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
				Logout
			</a>
		<?php } else { ?>
			<a class="signin-link open-modal" href="#">
				Login
			</a>
		<?php } ?>
	<?php } ?>
</div>