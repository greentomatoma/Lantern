document.addEventListener('DOMContentLoaded', function() {

  const input = document.querySelector('.validate-target');
  const form = document.querySelector('.form-area');

  if(!form) {
    return;
  }

    input.addEventListener('input', function(event) {
        const target = event.currentTarget;
        const feedback = target.nextElementSibling;
        
        if(!feedback.classList.contains('invalid-feedback')) {
          return;
        }

        if(target.checkValidity()) {
    
          target.classList.add('is-valid');
          target.classList.remove('is-invalid');

          feedback.textContent = '';

        } else {
          target.classList.add('is-invalid');
          target.classList.remove('is-valid');

          if(target.validity.tooShort) {
            feedback.textContent = target.minLength + '文字以上で入力してください。現在の文字数は' + target.value.length +'文字です。';
          }
        }
    });

});