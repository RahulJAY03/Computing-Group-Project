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

    <form id="uploadForm" action="../api/auth/addfile.php" method="post" encytpe="multipart/form-data">
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
                        <h6 id="fileName" class="file-name"></h6> 
                        <img class="trashicon" id="removeFile" src="../assets/images/Trash.png" style="cursor: pointer; display: none;">

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <select class="form-control" id="category" required>
                                    <option value="">Select a category</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="module" required>
                                    <option value="">Select a module name</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <select class="form-control" id="docType" required>
                                    <option value="Document_type">Document type</option>
                                    <option value="PDF">PDF</option>
                                    <option value="images">Image</option>
                                    <option value="Document">Document</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" id="language" required>
                                    <option value="">Language</option>
                                    <option value="english">English</option>
                                    <option value="sinhala">Sinhala</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control mt-3" id="description" placeholder="Add description" required>
                        <center><button type="submit" class="btn button-success mt-3"> <img src="../assets/images/icon.png"> Upload</button></center>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</form>    
</div>    

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/addnote2.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>