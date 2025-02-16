<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/module3.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    
    <div class="container">
        <div class="header-section">
            <h2>Database Management System
                <button class="joined-btn">Joined</button>
                <button class="add-doc-btn"><i class="bi bi-file-earmark-plus"></i></button></h2>
            <div class="header-buttons">
                <button class="share-btn"><i class="bi bi-share"></i></button>
                <button class="leave-btn"><i class="bi bi-box-arrow-right"></i> </button>
            </div>
        </div>
        <div class="tab-section">
            <button class="tab-btn active" onclick="toggleTab(this)">Document</button>
            <button class="tab-btn" onclick="toggleTab(this)">Discussion</button>
        </div>
        <div class="filter-bar">
            <span>30 Documents</span>
            <button class="filter-btn"><i class="bi bi-funnel"></i> Filter</button>
        </div>
        <div class="document-list">
            <div class="document-item">
            <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
            <div class="document-item">
                <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
            <div class="document-item">
                <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
            <div class="document-item">
                <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
            <div class="document-item">
                <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
            <div class="document-item">
                <img src="/assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
                <div class="document-info">
                    <h3><a href="#">IntroductionToDb.pdf</a></h3>
                    <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                    <div class="document-actions">
                        <button class="comment-btn"><i class="bi bi-chat-dots"></i> 2</button>
                        <button class="star-btn"><i class="bi bi-star"></i> 5</button>
                        <button class="download-btn"><i class="bi bi-download"></i> 10</button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>