<div class="ckd-user-directory">
    <div class="ckd-dir-heading">
        <h2>User Directory</h2>
    </div>
    <div class="ckd-dir-body grid">
        <?php foreach ($users as $user): ?>
            <div class="ckd-dir-item">
                <div class="ckd-dir-item-avatar-section">
                    <div class="ckd-dir-overlay"></div>
                    <img 
                        src="<?php echo esc_html( $this->get_user_avatar($user) ); ?>" 
                        class="ckd-dir-item-avatar" 
                        alt="<?php echo esc_html( $this->role_name ); ?>"
                    />
                    <div class="ckd-dir-avatar-badge">
                        <?php echo esc_html( $this->role_key === 'cooler_kid' ? 'You can\'t view this user\'s role.' : wp_roles()->get_names()[$user->roles[0]] ); ?>
                    </div>
                </div>
                <div class="ckd-dir-item-details-section">
                    <div class="ckd-dir-overlay"></div>
                    <?php if ( $this->role_key !== 'cooler_kid' ) { ?>
                        <div class="ckd-dir-details-item">
                            <h6>Email Address</h6>
                            <p><?php echo esc_html( $user->user_email ); ?></p>
                        </div>
                    <?php } ?>
                    <div class="ckd-dir-details-item">
                        <h6>First Name</h6>
                        <p><?php echo esc_html( $user->first_name ); ?></p>
                    </div>
                    <div class="ckd-dir-details-item">
                        <h6>Last Name</h6>
                        <p><?php echo esc_html( $user->last_name ); ?></p>
                    </div>
                    <div class="ckd-dir-details-item">
                        <h6>Country</h6>
                        <p><?php echo esc_html( $user->country ); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Custom Pagination Links -->
    <div class="ckd-pagination">
        <?php if ($current_page > 1): ?>
            <a href="<?php echo esc_url(add_query_arg('paged', $current_page - 1)); ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $current_page): ?>
                <span class="current"><?php echo $i; ?></span>
            <?php else: ?>
                <a href="<?php echo esc_url(add_query_arg('paged', $i)); ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="<?php echo esc_url(add_query_arg('paged', $current_page + 1)); ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>