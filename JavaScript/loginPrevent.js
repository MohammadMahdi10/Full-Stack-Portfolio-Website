const form = document.querySelector('form');
const loginButton = document.getElementById('loginButton');

loginButton.addEventListener('click', function(event) 
{
    const emailField = form.elements['email'];
    const passwordField = form.elements['password'];
    const errorText = document.getElementById('errorText');

    let hasError = false;

    emailField.style.backgroundColor = '';
    passwordField.style.backgroundColor = '';
    errorText.textContent = '';

    if (emailField.value.trim() === "") 
    {
        emailField.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
        hasError = true;
    }

    if (passwordField.value.trim() === "") 
    {
        passwordField.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
        hasError = true;
    }

    if (hasError) 
    {
        event.preventDefault();
        errorText.textContent = 'Email and password are required.';
        errorText.style.color = 'red';
        errorText.style.marginTop = '0.6rem';
    }
});
