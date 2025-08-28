const form = document.getElementById('blogForm');
const titleInput = document.getElementById('postTitle');
const titleCountDisplay = document.getElementById('titleCount');
const contentInput = document.getElementById('postContent');
const contentCountDisplay = document.getElementById('contentCount');

function updateTitleCount() 
{
    titleCountDisplay.textContent = titleInput.value.length;
}

function updateContentCount() 
{
    contentCountDisplay.textContent = contentInput.value.length;
}

function initializeCounters() 
{
    updateTitleCount();
    updateContentCount();
}

function resetCounters() 
{
    titleInput.value = "";
    contentInput.value = "";
    titleCountDisplay.textContent = 0;
    contentCountDisplay.textContent = 0;
}


initializeCounters();

titleInput.addEventListener('input', updateTitleCount);
contentInput.addEventListener('input', updateContentCount);
form.addEventListener('reset', resetCounters);



