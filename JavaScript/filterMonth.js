const monthSelect = document.getElementById('month');

if (monthSelect) 
{
    monthSelect.addEventListener('change', function () 
    {
        document.getElementById('monthForm').submit();
    });
}
