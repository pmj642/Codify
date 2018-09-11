//  JavaScript to make submissions

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let reader = new FileReader();
    let langType;

    if(file === null)
    {
        alert('Please select a file!');
        return;
    }
    else if(fileType === null)
    {
        alert('Please select a language!');
        return;
    }

    switch (fileType) {
        case 'C++':
                    langType = 12;
                    break;
        case 'Java':
                    langType = 27;
                    break;
        default:
                    langType = 43;
    }

    reader.onload = function () {
        let xhr = new XMLHttpRequest();
        let url = "../app/submit.php";

        let request = {
            source_code: reader.result,
            language_id: langType
        };

        xhr.responseType = 'application/json';

        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                console.log("THIS IS THE RESPONSE\n" + xhr.response);
                // let outDiv = document.createElement('div');
//                 outDiv.setAttribute('style',"border: solid 1px #000;
//                                              padding: 20px;
//                                              font: 400 22px Helvetica;  ");

                // outDiv.innerHTML =    "Time: " + xhr.response.time + "<br/>"
                //                     + "Memory: " + xhr.response.memory + "<br/>"
                //                     + "Output: " + xhr.response.stdout + "<br/>";
                // result.appendChild(outDiv);
              }
        };

        console.log(JSON.stringify(request));

        xhr.open("POST",url);
        xhr.setRequestHeader("Content-type", "application/json");

        xhr.send(JSON.stringify(request));

        console.log(reader.result);
    };

    reader.readAsText(file);

    console.log("Hello");
    console.log(langType);
    console.log(file.type);
}
