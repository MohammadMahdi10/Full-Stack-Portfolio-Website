const forms = document.querySelectorAll('form[id="addCommentForm"]');

for (let i=0; i<forms.length; i++) 
{
    const form = forms[i];
    const commentField = form.querySelector('#comment');
    const addButton = form.querySelector('#addCommentButton');

    let errorText = form.querySelector('.errorText');
    if (!errorText) 
    {
        errorText = document.createElement('p');
        errorText.className = 'errorText';
        form.appendChild(errorText);
    }

    addButton.addEventListener('click', function(event) 
    {
        let hasError = false;

        commentField.style.backgroundColor = '';
        errorText.textContent = '';

        if (commentField.value.trim() === "") 
        {
            commentField.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
            errorText.textContent = 'Comment box cannot be empty.';
            errorText.style.color = 'red';
            errorText.style.marginTop = '0.6rem';
            hasError = true;
        }

        if (hasError) 
        {
            event.preventDefault();
        }
    });
}