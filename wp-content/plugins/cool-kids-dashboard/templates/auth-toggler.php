<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
    <?php if (is_user_logged_in()): ?>
        <h2 class="wp-block-heading ckn-content-toggle-heading has-text-align-left has-ckn-kanit-font-family">
            Welcome back <?php echo esc_html( ucfirst( $this->user->first_name ) ); ?>! <br> How does it feel to be
        </h2>

        <h2 class="ckn-content-toggle-subheading has-text-align-left has-text-color has-link-color has-ckn-kanit-font-family">
            <?php echo esc_html( ucfirst( $this->display_formatted_role() ) ); ?>?
        </h2>

        <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
            <div class="wp-block-button direct-signup-btn has-ckn-montserrat-font-family">
                <a href="<?php echo esc_url( $this->get_dashboard_url() ); ?>" class="wp-block-button__link ckn-content-toggle-button has-ckn-gray-800-color has-text-color has-link-color wp-element-button">
                    My Dashboard
                </a>
            </div>
        </div>
    <?php else: ?>
        <h2 class="wp-block-heading ckn-content-toggle-heading has-text-align-left has-ckn-kanit-font-family">
        Hey, Wanna Be Cool?
        </h2>

        <h2 class="wp-block-heading ckn-content-toggle-subheading has-text-align-left has-text-color has-link-color has-ckn-kanit-font-family">
            Join The Coolest Kids In The World.
        </h2>

        <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
            <div class="wp-block-button direct-signup-btn has-ckn-montserrat-font-family">
                <a class="wp-block-button__link ckn-content-toggle-button has-ckn-gray-800-color has-text-color has-link-color wp-element-button">
                Get Started
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>