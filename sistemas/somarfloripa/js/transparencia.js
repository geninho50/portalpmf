function mostra(id)
{
    if(document.getElementById('hidden').style.display == 'none')
    {
        document.getElementById('hidden').style.display ='block';
        document.getElementById('btnMenu').value="menu";
    }else
    {
        document.getElementById('hidden').style.display = 'none';
        document.getElementById('btnMenu').value="menu";
    }
}
