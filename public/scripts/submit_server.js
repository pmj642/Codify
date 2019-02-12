//  JavaScript to make submissions

function displayResult(responseObj)
{
    responseObj = JSON.parse(responseObj);
    console.log("RESPONSE\n" + responseObj);

    let result = document.getElementById('result');
    let verdict = document.getElementById('verdict');
    let resultBox = document.getElementsByClassName('result-box');
    let verdict_img;

    if(responseObj.status.description === "Accepted")
        verdict_img = "<img src='../public/images/correct-icon.png'>";
    else if(responseObj.status.description === "Compilation Error")
        verdict_img = "<img src='../public/images/compilation-icon.png'>";
    else if(responseObj.status.description === "Wrong Answer")
        verdict_img = "<img src='../public/images/wrong-icon.png'>";

    verdict.innerHTML = "<h1>" + responseObj.status.description + "</h1>" + verdict_img;

    if(responseObj.status.description === "Accepted")
    {
        result.innerHTML =    "<img src='../public/images/clock-icon.png'>" + responseObj.time + " sec<br/>"
                            + "<img src='../public/images/memory-icon.png'>" + responseObj.memory + " kB<br/>"
                            + "<img src='../public/images/output-icon.png'>" + responseObj.stdout;

        verdict.style.width = result.style.width = "50%";
    }
    else
    {
        result.innerHTML = "";
        verdict.style.width = "100%";
        result.style.width = "0";
    }

    resultBox[0].style.visibility = "visible";
}

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let questionId;
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

    // get the question id from the url

    let urlParams = new URLSearchParams(location.search);
    questionId = urlParams.get('id');

    reader.onload = function () {
        let xhr = new XMLHttpRequest();
        let url = "../app/submit.php";

        let request = {
            source_code: reader.result,
            language_id: langType,
            question_id: questionId
        };

        xhr.responseType = 'application/json';

        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                displayResult(xhr.response);
              }
        };

        xhr.open("POST",url);
        xhr.setRequestHeader("Content-type", "application/json");

        xhr.send(JSON.stringify(request));
    };

    reader.readAsText(file);
}
