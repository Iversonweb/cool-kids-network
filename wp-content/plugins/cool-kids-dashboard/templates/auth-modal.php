<div class="wp-block-cool-kids-dashboard-auth-modal">
  <div class="modal-container">
    <div class="modal-overlay"></div>

    <span class="modal-trick">&#8203;</span>

    <div class="modal-content">
      <button class="modal-btn-close" type="button">
        <i class="bi bi-x"></i>
      </button>
      <!-- Tabs -->
      <ul class="tabs">
        <!-- Login Tab -->
        <li>
          <a href="#signin-tab" class="active-tab">
            <i class="bi bi-key"></i>Login
          </a>
        </li>
        <?php if( $atts['showRegister'] ) { ?>
        <!-- Register Tab -->
        <li>
          <a href="#signup-tab">
            <i class="bi bi-person-plus-fill"></i>Sign up
          </a>
        </li>
        <?php } ?>
      </ul>
      <div class="modal-body">
        <!-- Login Form -->
        <form id="signin-tab" style="display: block;">
          <div id="signin-status"></div>
          <p class="welcome-text">Welcome back cool kid! Enter email below.</p>
          <fieldset>
            <label>Enter Email</label>
            <input type="text" id="ckn-signin-email" placeholder="johndoe@example.com" />

            <button type="submit">Login</button>
          </fieldset>
        </form>
        <?php if( $atts['showRegister'] ) { ?>
        <!-- Register Form -->
        <form id="signup-tab">
          <div id="signup-status"></div>
          <p class="welcome-text">Wanna join the cool kids? All we need is your email.</p>
          <fieldset>
            <label>Enter Email</label>
            <input type="email" id="ckn-signup-email" placeholder="johndoe@example.com" />

            <button type="submit">Sign up</button>
          </fieldset>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>