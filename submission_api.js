//  JavaScript to make submissions

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let reader = new FileReader();
    let stdin = document.getElementById('stdin').value;
    let result = document.getElementById('result');
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
    if(file === null)
    {
        alert('Please select a file!');  
        return;
    }
    else if(stdin === null)
    {
        alert('Please give some input for the program!');  
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
        let url = "https://api.judge0.com/submissions/?base64_encoded=false&wait=true";

        let request = {
            "source_code": reader.result,
            "language_id": langType,
            "stdin": stdin
        };

        xhr.responseType = 'json';
        
        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                console.log(JSON.parse(xhr.response));
                let outDiv = document.createElement('div');
                outDiv.style.padding = "20px";
                outDiv.innerHTML =    "Time: " + xhr.response.time + "<br/>"
                                    + "Memory: " + xhr.response.memory + "<br/>"
                                    + "Output: " + xhr.response.stdout + "<br/>";
                result.appendChild(outDiv);
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
