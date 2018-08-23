
function getTemplate()
{
        let header = document.getElementById('header');
        let footer = document.getElementById('footer');

        ajax(header);
        ajax(footer);
}

function ajax(element)
{
    // change domain for the website
    let domain = "https://codify.herokuapp.com/";
    let xhr = new XMLHttpRequest();
    let url = domain + element.getAttribute('id') + '.html';

    xhr.responseType = 'text/html';
    xhr.open("GET",url);

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            console.log(xhr.response);
            element.innerHTML = xhr.response;
        }
    }

    xhr.send();
}
