<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/addnote2.css">

    
    <title>Document</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    
<div class="content">
       
    <div class="main-content">
        <h2><strong>Upload on <br>The Kuppiya</strong></h2>
        <p>Earn <span><img src="../assets/images/coin7.png" alt="coin"></span> credits by uploading and sharing your<br> study notes</p>

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
                    <p><center>DOCUMENTS: 1</center></p>
                    <div class="file-drop" id="drop-area">
                    <img src="../assets/images/add.png" id="addIcon" style="cursor: pointer;">
                    <input type="file" id="fileInput" style="display: none;">

                    <script>
                            document.getElementById("addIcon").addEventListener("click", function() {
                            document.getElementById("fileInput").click();
                            });
                    </script>
                        <p><strong>Add more files</strong></p>
                        <p class="file-info">Max file size: 100MB. Supported: PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP</p>
                        <input type="file" id="fileInput" hidden>
                    </div>
                </div>

                <!-- Form Box -->
                <div class="col-md-8">
                    <div class="form-container">
                        <h5 class="file-name">Images.jpg</h5> <img  class="trashicon" src="../assets/images/Trash.png">
                        <div class="d-flex gap-3">
                            <label><input type="checkbox" id="anonymously"> Upload anonymously</label>
                            <label><input type="checkbox" id= "self_created"> Self-created</label>
                        </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                            <select class="form-control">
                                <option>Select a module name</option>
                                <option>database </option>
                            </select>
                    </div>
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Select a category</option>
                                    <option>ICT</option>
                                </select>
                            </div>
                    </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <select class="form-control">
                                    <option>Document type</option>
                                    <option>PDF</option>
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
                        <center><button class="btn button-success  mt-3">  <img src="../assets/images/icon.png"> Upload</button></center>
                    </div>
                </div>
            </div>
        </div>
</div>    

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(event) {
        let href = this.getAttribute('href');
        if (href !== '#' && href) {
            window.location.href = href;
        }
    });
});
</script>


</body>
</html>