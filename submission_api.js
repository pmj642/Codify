//  JavaScript to make submissions

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let reader = new FileReader();
    let langType;

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
        let url = "https://api.judge0.com/submissions/?base64_encoded=false&wait=false";

        let request = {
            source_code: reader.result,
            language_id: langType,
            stdin: "1 2 4 2 3"
        };

        xhr.setRequestHeader("Content-type", "application/json");
        
        xhr.onReadyStateChange = function() {
            let st = xhr.response;
            let resp = JSON.parse(st);
            console.log(resp);
        };
        
        console.log(JSON.stringify(request));

        xhr.open("POST",url,true);
        xhr.send(JSON.stringify(request));

        console.log(reader.result);
    };

    reader.readAsText(file);

    console.log("Hello");
    console.log(langType);
    console.log(file.type);
}
