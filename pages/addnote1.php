<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addnote.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Add Notes</title>
    <style>
        .file-drop {
            border: 2px dashed #28a745;
            padding: 20px;
            text-align: center;
            position: relative;
            cursor: pointer;
        }
        .file-preview {
            margin-top: 10px;
            display: none;
            max-width: 100%;
            height: auto;
        }
        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

    <?php
        include '../includes/navbar.php';  
        include '../includes/sidebar.php'; 
    ?>

<div class="green_center_box">
    <h2>Select your files</h2>
    <h6>Earn <img src="../assets/images/coin7.png" alt="coin"> credits by uploading and sharing your study notes</h6>

    <div class="steps">
        <div class="step">
            <div class="circle">1</div>
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

    <div class="file-drop" id="drop-area">
        <i class="bi bi-upload upload-icon"></i>
        <p><strong>Drag & drop files here to upload</strong></p>
        <p class="file-info">Max file size: 100MB. Supported files: PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP</p>
        <input type="file" id="fileInput" hidden>
        <img id="filePreview" class="file-preview">
        <p id="fileName" class="file-name"></p>
    </div>

    <button class="browse-btn" onclick="document.getElementById('fileInput').click()" id="uploadbutton">Or browse files here</button>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Upload Successful</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your file has been uploaded successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="continueBtn">Continue</button>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
const fileInput = document.getElementById('fileInput');
const filePreview = document.getElementById('filePreview');
const fileName = document.getElementById('fileName');
const dropArea = document.getElementById('drop-area');

fileInput.addEventListener('change', function(event) {
    handleFileSelection(event.target.files[0]);
});

// Handle drag & drop functionality
dropArea.addEventListener('dragover', function(event) {
    event.preventDefault();
    dropArea.style.border = "2px solid #218838";
});

dropArea.addEventListener('dragleave', function() {
    dropArea.style.border = "2px dashed #28a745";
});

dropArea.addEventListener('drop', function(event) {
    event.preventDefault();
    dropArea.style.border = "2px dashed #28a745";
    
    const file = event.dataTransfer.files[0];
    fileInput.files = event.dataTransfer.files; // Assign the file to input
    handleFileSelection(file);
});

// Handle file selection and store it in sessionStorage
function handleFileSelection(file) {
    if (file) {
        const fileType = file.type;
        const reader = new FileReader();
        
        reader.onload = function(e) {
            sessionStorage.setItem('uploadedFile', e.target.result); // Store file as Base64
            sessionStorage.setItem('uploadedFileName', file.name); // Store file name

            if (fileType.startsWith("image/")) { // If it's an image, display it
                filePreview.src = e.target.result;
                filePreview.style.display = "block";
                fileName.textContent = "";
            } else { // If it's a document, show the file name
                filePreview.style.display = "none";
                fileName.textContent = "Selected file: " + file.name;
            }

            // Show success modal
            var modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
        };
        reader.readAsDataURL(file);
    }
}

// Redirect when clicking "Continue"
document.getElementById('continueBtn').addEventListener('click', function() {
    window.location.href = "addnote2.php";
});
</script>

</body>
</html>
