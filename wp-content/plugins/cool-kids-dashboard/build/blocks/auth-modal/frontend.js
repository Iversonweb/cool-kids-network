/******/ (() => { // webpackBootstrap
/*!*******************************************!*\
  !*** ./src/blocks/auth-modal/frontend.js ***!
  \*******************************************/
document.addEventListener('DOMContentLoaded', () => {
  const openModalBtns = document.querySelectorAll('.open-modal');
  const directSignupBtn = document.querySelector('.direct-signup-btn');
  const modalElement = document.querySelector('.wp-block-cool-kids-dashboard-auth-modal');
  const modalCloseElements = document.querySelectorAll('.modal-overlay, .modal-btn-close');
  const tabs = document.querySelectorAll('.tabs a');
  const signinForm = document.querySelector('#signin-tab');
  const signinFieldset = signinForm.querySelector('fieldset');
  const signinStatus = signinForm.querySelector('#signin-status');
  const signupForm = document.querySelector('#signup-tab');
  const signupFieldset = signupForm.querySelector('fieldset');
  const signupStatus = signupForm.querySelector('#signup-status');
  const showModal = () => modalElement?.classList.add('modal-show');
  const hideModal = () => modalElement?.classList.remove('modal-show');
  directSignupBtn?.addEventListener('click', event => {
    event.preventDefault();
    showModal();
    switchTab('signup');
  });
  const switchTab = tabName => {
    tabs.forEach(tab => tab.classList.remove('active-tab'));
    if (tabName === 'signin') {
      signinForm.style.display = "block";
      signupForm.style.display = "none";
      tabs[0].classList.add('active-tab');
    } else {
      signupForm.style.display = "block";
      signinForm.style.display = "none";
      tabs[1].classList.add('active-tab');
    }
  };
  openModalBtns.forEach(button => button.addEventListener('click', event => {
    event.preventDefault();
    showModal();
    switchTab('signin');
  }));
  modalCloseElements.forEach(element => element.addEventListener('click', event => {
    event.preventDefault();
    hideModal();
  }));
  tabs.forEach(tab => tab.addEventListener('click', event => {
    event.preventDefault();
    const activeTab = event.currentTarget.getAttribute('href') === '#signin-tab' ? 'signin' : 'signup';
    switchTab(activeTab);
  }));
  const displayStatus = (statusElement, type, message) => {
    statusElement.innerHTML = `
            <div class="modal-status modal-status-${type}">
                <div>${message}</div>
            </div>
        `;
  };
  const handleFormError = (statusElement, responseData) => {
    const {
      message
    } = responseData;
    displayStatus(statusElement, 'danger', message || 'An error occurred. Please try again.');
  };
  signupForm.addEventListener('submit', async event => {
    event.preventDefault();
    signupFieldset.setAttribute('disabled', true);
    displayStatus(signupStatus, 'info', 'Yo chill! We are creating your account.');
    const formData = {
      email: signupForm.querySelector('#ckn-signup-email').value.trim()
    };
    try {
      const response = await fetch(ckn_auth_rest.signup, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });
      const responseData = await response.json();
      if (response.ok && responseData.status === 'success') {
        displayStatus(signupStatus, 'success', "Niicceee! You're now a cool kid.");
        setTimeout(() => location.reload(), 1500);
      } else {
        handleFormError(signupStatus, responseData);
      }
    } catch (error) {
      displayStatus(signupStatus, 'danger', error.message);
    } finally {
      signupFieldset.removeAttribute('disabled');
    }
  });
  signinForm.addEventListener('submit', async event => {
    event.preventDefault();
    signinFieldset.setAttribute('disabled', true);
    displayStatus(signinStatus, 'info', "Yo chill! We are checking if you're a cool kid.");
    const formData = {
      email: signinForm.querySelector('#ckn-signin-email').value.trim()
    };
    try {
      const response = await fetch(ckn_auth_rest.signin, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });
      const responseData = await response.json();
      if (response.ok && responseData.status === 'success') {
        displayStatus(signinStatus, 'success', "Welcome back! Stay cool.");
        setTimeout(() => location.reload(), 1500);
      } else {
        handleFormError(signinStatus, responseData);
      }
    } catch (error) {
      displayStatus(signinStatus, 'danger', error.message);
    } finally {
      signinFieldset.removeAttribute('disabled');
    }
  });
});
/******/ })()
;
//# sourceMappingURL=frontend.js.map