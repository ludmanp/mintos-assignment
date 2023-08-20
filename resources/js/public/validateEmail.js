export const InitEmailValidation = () => {
  const emailInput = document.querySelector("[data-validate-email]");
  const errorNotifications = document.querySelector("[data-error]")
  if(emailInput) {
    const form = emailInput.closest('form');
    const button = form.querySelector('button[type=submit]');
    let controller = new AbortController();

    emailInput.addEventListener('keyup', () => {

      if(!emailInput.value) {
        errorNotifications.classList.add('hidden');
        button.disabled = true;
        return;
      }
      controller.abort();
      controller = new AbortController();
      axios
        .post("/validate-email", {
          email: emailInput.value
        }, {
          signal: controller.signal
        })
        .then((response) => {
          errorNotifications.classList.add('hidden');
          button.disabled = false;
        })
        .catch((error) => {
          button.disabled = true;
          let errors = [];
          if(error.response?.data?.errors) {
            for (var key in error.response.data.errors) {
              for (var value of error.response.data.errors[key]) {
                errors.push(value);
              }
            }
          }
          errorNotifications.classList.remove('hidden');
          errorNotifications.innerHTML = errors.join('<br>');
        });
    });

    if(emailInput.value) {
      emailInput.dispatchEvent(new Event('keyup'));
    }
  }
}
