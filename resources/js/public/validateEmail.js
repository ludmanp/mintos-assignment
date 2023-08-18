export const InitEmailValidation = () => {
  const emailInput = document.querySelector("[data-validate-email]");
  const errorNotifications = document.querySelector("[data-error]")
  if(emailInput) {
    const form = emailInput.closest('form');
    const button = form.querySelector('button[type=submit]');
    emailInput.addEventListener('change', () => {
      axios
        .post("/validate-email", {
          email: emailInput.value
        })
        .then((response) => {
          errorNotifications.classList.add('hidden');
          button.disabled = false;
        })
        .catch((error) => {
          button.disabled = true;
          let errors = [];
          for(var key in error.response.data.errors) {
            for(var value of error.response.data.errors[key]) {
              errors.push(value);
            }
          }
          errorNotifications.classList.remove('hidden');
          errorNotifications.innerHTML = errors.join('<br>');
        });
    });
  }
}
