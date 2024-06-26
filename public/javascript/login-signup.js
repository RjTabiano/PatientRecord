const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


function showToast(message, type = 'error') {
  const toaster = document.getElementById('toaster');

  const toast = document.createElement('div');
  toast.className = 'toast ' + (type === 'error' ? 'toast-error' : 'toast-success');

  const description = document.createElement('div');
  description.className = 'description';
  description.textContent = message;

  const cancelButton = document.createElement('button');
  cancelButton.className = 'cancel-button';
  cancelButton.textContent = 'Dismiss';
  cancelButton.addEventListener('click', () => hideToast(toast));

  toast.appendChild(description);
  toast.appendChild(cancelButton);

  toaster.appendChild(toast);

  setTimeout(() => hideToast(toast), 5000); 
}

function hideToast(toast) {
  toast.classList.add('hide');
  toast.addEventListener('transitionend', () => toast.remove());
}