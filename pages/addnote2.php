<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addnote2.css">
    
    <title>Upload Notes</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  
        include '../includes/sidebar.php'; 
    ?>
    
<div class="content">
    <div class="main-content">
        <h2><strong>Upload on <br>The Kuppiya</strong></h2>
        <p>Earn <span><img src="../assets/images/coin7.png" alt="coin"></span> credits by uploading and sharing your study notes</p>

        <!-- Progress Steps -->
        <div class="progress-container">
            <div class="step completed">
                <div class="circle"></div>
                <p>Select file</p>
            </div>
            <div class="step">
                <div class="circle">2</div>
                <p>Add info</p>
            </div>
            <div class="step">
                <div class="circle">3</div>
                <p>Earn rewards</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- File Upload Box -->
                <div class="col-md-4">
                    <p><center>DOCUMENTS: <span id="docCount">0</span></center></p>
                    <div class="file-drop" id="drop-area">
                        <img src="../assets/images/add.png" id="addIcon" style="cursor: pointer;">
                        <input type="file" id="fileInput" multiple hidden>
                        <div id="filePreviewContainer"></div> <!-- This will hold uploaded files -->
                        <p><strong>Add more files</strong></p>
                        <p class="file-info">Max file size: 100MB. Supported: PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP</p>
                    </div>
                </div>

                <!-- Form Box -->
                <div class="col-md-8">
                    <div class="form-container">
                        <h5 id="fileName" class="file-name"></h5> 
                        <img class="trashicon" id="removeFile" src="../assets/images/Trash.png" style="cursor: pointer; display: none;">

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Select a category</option>
                                    <option>IT</option>
                                    <option>BUSINESS</option>
                                    <option>SCIENCE</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Select a module name</option>
                                    <option>Introduction to Computer Science</option>
                                    <option>Programming in C</option>
                                    <option>Computer Architecture</option>
                                    <option>Introduction to IOT</option>
                                    <option>Mobile Application Development</option>
                                    <option>Mathematics for Computing</option>
                                    <option>Computer Networks</option>
                                    <option>Information Management and Retrieval</option>
                                    <option>Algorithms and Data Structures</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Document type</option>
                                    <option>PDF</option>
                                    <option>Image</option>
                                    <option>Doc</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Language</option>
                                    <option>English</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control mt-3" placeholder="Add description">
                        <center><button class="btn button-success mt-3"> <img src="../assets/images/icon.png"> Upload</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>    

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("addIcon").addEventListener("click", function() {
    document.getElementById("fileInput").click();
});

const fileInput = document.getElementById('fileInput');
const filePreviewContainer = document.getElementById('filePreviewContainer');
const fileName = document.getElementById('fileName');
const removeFile = document.getElementById('removeFile');
const docCount = document.getElementById('docCount');
let documentCounter = 0; // Counter for files

fileInput.addEventListener('change', function() {
    Array.from(fileInput.files).forEach(file => {
        handleFileSelection(file);
    });
});

function handleFileSelection(file) {
    const fileType = file.type;
    const reader = new FileReader();
    const previewElement = document.createElement('div');
    previewElement.style.marginTop = "10px";

    if (fileType.startsWith("image/")) {
        reader.onload = function(e) {
            previewElement.innerHTML = `<img src="${e.target.result}" class="file-preview" style="max-width: 100%; height: auto;">`;
        };
        reader.readAsDataURL(file);
    } else {
        previewElement.innerHTML = `<p class="file-name">📄 ${file.name}</p>`;
    }

    filePreviewContainer.appendChild(previewElement);
    fileName.textContent = file.name;
    removeFile.style.display = "block";

    documentCounter++;
    docCount.textContent = documentCounter;
}

// Remove all uploaded files when clicking the trash icon
removeFile.addEventListener('click', function() {
    filePreviewContainer.innerHTML = "";
    fileName.textContent = "";
    removeFile.style.display = "none";
    documentCounter = 0;
    docCount.textContent = documentCounter;
});
</script>

</body>
</html>
