const forms = document.getElementById('blogForm');
const post = document.getElementById('post');
const preview = document.getElementById('preview');
const errorText = document.getElementById('errorText');

function validateAndSubmit(event, targetAction) 
{
    const title = forms.elements['title'];
    const content = forms.elements['content'];

    let hasError = false;
    errorText.textContent = '';
    title.style.backgroundColor = '';
    content.style.backgroundColor = '';

    if (title.value.trim() === '') 
    {
        title.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
        hasError = true;
    }

    if (content.value.trim() === '') 
    {
        content.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
        hasError = true;
    }

    if (hasError) 
    {
        event.preventDefault();
        errorText.textContent = 'Title and content are required.';
        errorText.style.color = 'red';
        errorText.style.fontFamily = "merriweather", "Playfair Display";
    } 
    else 
    {
        forms.action = targetAction;
        forms.submit();
    }
}

preview.addEventListener('click', function(event) 
{
    validateAndSubmit(event, 'previewPost.php');
});

post.addEventListener('click', function(event) 
{
    validateAndSubmit(event, 'handlePost.php');
});
