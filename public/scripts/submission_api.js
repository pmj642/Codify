//  JavaScript to make submissions

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let reader = new FileReader();
    let stdin = document.getElementById('stdin').value;
    let result = document.getElementById('result');
    let verdict = document.getElementById('verdict');
    let expected_out = document.getElementById('stdout');
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
        let url = "https://api.judge0.com/submissions/?base64_encoded=false&wait=true";

        let request = {
            source_code: reader.result,
            language_id: langType,
            stdin: stdin
        };

        if(expected_out.value)
            request.expected_output = expected_out.value;

        xhr.responseType = 'json';

        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {

                console.log(xhr.response);
                // let outDiv = document.createElement('div');

                let status = xhr.response.status;
                let verdict_img;

                if(status.description === "Accepted")
                    verdict_img = "<img src='../public/images/correct-icon.png'>";
                else if(status.description === "Compilation Error")
                    verdict_img = "<img src='../public/images/compilation-icon.png'>";
                else if(status.description === "Wrong Answer")
                    verdict_img = "<img src='../public/images/wrong-icon.png'>";

                verdict.innerHTML = "<h1>" + status.description + "</h1>" + verdict_img;

                if(status.description === "Accepted")
                {
                    result.innerHTML =    "<img src='../public/images/clock-icon.png'>" + xhr.response.time + " sec<br/>"
                                        + "<img src='../public/images/memory-icon.png'>" + xhr.response.memory + " kB<br/>"
                                        + "<img src='../public/images/output-icon.png'>" + xhr.response.stdout;


                    verdict.style.width = result.style.width = "50%";
                }
                else
                {
                    result.innerHTML = "";
                    verdict.style.width = "100%";
                    result.style.width = "0";
                }

                // result.appendChild(outDiv);
              }
        };

        // console.log(JSON.stringify(request));

        xhr.open("POST",url);
        xhr.setRequestHeader("Content-type", "application/json");

        xhr.send(JSON.stringify(request));

        // console.log(reader.result);
    };

    reader.readAsText(file);

    // console.log("Hello");
    // console.log(langType);
    // console.log(file.type);
}
