<div class="ckd-user-dashboard">
    <div class="ckd-welcome-section">
        <div class="ckd-overlay"></div>
        <div class="ckd-welcome-header">
            <h2>
                Howdy <?php echo esc_html( $this->user->first_name ); ?>! <br>
                Cheers to being 
                <span class="ckd-special-text">
                    <?php echo esc_html( $this->display_formatted_role() ); ?>
                </span> 
                on the block.
            </h2>
        </div>
        <div class="ckd-welcome-subtext">
            <p>
                Let's see what's going on in your dashboard today.
            </p>
        </div>
    </div>
    <div class="ckd-dashboard-content-section">
        <div class="ckd-overlay"></div>
        <div class="ckd-dashboard-content-container">
            <div class="ckd-dashboard-avatar-section">
                <img 
                    src="<?php echo esc_html( $this->get_role_avatar() ); ?>" 
                    class="ckd-dashboard-avatar" 
                    alt="<?php echo esc_html( $this->role_name ); ?>"
                />
                <div class="ckd-dashboard-avatar-badge">
                    Your <?php echo esc_html( $this->role_name ); ?> Avatar
                </div>
            </div>
            <div class="ckd-dashboard-details-section">
                <div class="ckd-dashboard-details-item">
                    <h6>My Email Address</h6>
                    <p><?php echo esc_html( $this->user->user_email ); ?></p>
                </div>
                <div class="ckd-dashboard-details-item">
                    <h6>My First Name</h6>
                    <p><?php echo esc_html( $this->user->first_name ); ?></p>
                </div>
                <div class="ckd-dashboard-details-item">
                    <h6>My Last Name</h6>
                    <p><?php echo esc_html( $this->user->last_name ); ?></p>
                </div>
                <div class="ckd-dashboard-details-item">
                    <h6>My Country</h6>
                    <p><?php echo esc_html( $this->user->country ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>