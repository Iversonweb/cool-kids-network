<div class="ckd-user-directory">
	<div class="ckd-dir-heading">
		<h2>User Directory</h2>
	</div>
	<div class="ckd-dir-body grid">
		<?php foreach ( $users as $ckd_cool_kids_user ) : ?>
			<div class="ckd-dir-item">
				<div class="ckd-dir-item-avatar-section">
					<div class="ckd-dir-overlay"></div>
					<img 
						src="<?php echo esc_html( $this->get_user_avatar( $ckd_cool_kids_user ) ); ?>" 
						class="ckd-dir-item-avatar" 
						alt="<?php echo esc_html( $this->role_name ); ?>"
					/>
					<div class="ckd-dir-avatar-badge">
						<?php echo esc_html( 'cooler_kid' === $this->role_key ? 'You can\'t view this user\'s role.' : wp_roles()->get_names()[ $ckd_cool_kids_user->roles[0] ] ); ?>
					</div>
				</div>
				<div class="ckd-dir-item-details-section">
					<div class="ckd-dir-overlay"></div>
					<?php if ( 'cooler_kid' !== $this->role_key ) { ?>
						<div class="ckd-dir-details-item">
							<h6>Email Address</h6>
							<p><?php echo esc_html( $ckd_cool_kids_user->user_email ); ?></p>
						</div>
					<?php } ?>
					<div class="ckd-dir-details-item">
						<h6>First Name</h6>
						<p><?php echo esc_html( $ckd_cool_kids_user->first_name ); ?></p>
					</div>
					<div class="ckd-dir-details-item">
						<h6>Last Name</h6>
						<p><?php echo esc_html( $ckd_cool_kids_user->last_name ); ?></p>
					</div>
					<div class="ckd-dir-details-item">
						<h6>Country</h6>
						<p><?php echo esc_html( $ckd_cool_kids_user->country ); ?></p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Custom Pagination Links -->
	<div class="ckd-pagination">
		<?php if ( $current_page > 1 ) : ?>
			<a href="<?php echo esc_url( add_query_arg( 'paged', $current_page - 1 ) ); ?>">&laquo; Previous</a>
		<?php endif; ?>

		<?php for ( $ckd_page = 1; $ckd_page <= $total_pages; $ckd_page++ ) : ?>
			<?php if ( $current_page === $ckd_page ) : ?>
				<span class="current"><?php echo esc_html( $ckd_page ); ?></span>
			<?php else : ?>
				<a href="<?php echo esc_url( add_query_arg( 'paged', $ckd_page ) ); ?>"><?php echo esc_html( $ckd_page ); ?></a>
			<?php endif; ?>
		<?php endfor; ?>

		<?php if ( $current_page < $total_pages ) : ?>
			<a href="<?php echo esc_url( add_query_arg( 'paged', $current_page + 1 ) ); ?>">Next &raquo;</a>
		<?php endif; ?>
	</div>
</div>