<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sessions</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link 
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" 
    rel="stylesheet"
  >
  <!-- Custom Styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/discussion.css">
  <link rel="stylesheet" href="../assets/css/module3.css"> <!-- Additional Styles for Documents -->
</head>
<body>
  <?php
      include '../includes/navbar.php';  // Navbar include
      include '../includes/sidebar.php'; // Sidebar include
  ?>
  
  <div class="container">
    <!-- Header Section -->
    <div class="header-section">
      <h2>
        Database Management System
      </h2>
    </div>

    <!-- Tabs -->
    <div class="tab-section">
      <button class="tab-btn active" onclick="toggleTab(this, 'document-content')">Document</button>
      <button class="tab-btn" onclick="toggleTab(this, 'discussion-content')">Discussion</button>
    </div>

    <!-- Document Content (Visible by default) -->
    <div id="document-content" class="tab-content">
      <div class="filter-bar">
          <span>30 Documents</span>
          <button class="filter-btn"><i class="bi bi-funnel"></i> Filter</button>
      </div>
      <div class="document-list">
          <div class="document-item">
              <img src="../assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
              <div class="document-info">
                  <h3><a href="#">IntroductionToDb.pdf</a></h3>
                  <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                  <div class="document-actions">
                    <div class="left">
                        <button class="star-btn"><i class="bi bi-heart"></i> 5</button>
                    </div>
                   <div class="right">
                        <button class="download-btn"><i class="bi bi-download"></i></button>
                        <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                    </div>
                </div>

              </div>
          </div>

          <div class="document-item">
              <img src="../assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
              <div class="document-info">
                  <h3><a href="#">IntroductionToDb.pdf</a></h3>
                  <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                  <div class="document-actions">
                  <div class="left">
                     <button class="star-btn"><i class="bi bi-heart"></i> 5</button>
                  </div>
                  <div class="right">
                     <button class="download-btn"><i class="bi bi-download"></i></button>
                      <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                  </div>
              </div>

              </div>
          </div>

          <div class="document-item">
              <img src="../assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
              <div class="document-info">
                  <h3><a href="#">IntroductionToDb.pdf</a></h3>
                  <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                  <div class="document-actions">
                      <div class="left">
                          <button class="star-btn"><i class="bi bi-heart"></i> 5</button>
                     </div>
                      <div class="right">
                          <button class="download-btn"><i class="bi bi-download"></i></button>
                          <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                     </div>
                  </div>

              </div>
          </div>

          <div class="document-item">
              <img src="../assets/images/pdf-image.png" alt="Document Thumbnail" class="doc-img">
              <div class="document-info">
                  <h3><a href="#">IntroductionToDb.pdf</a></h3>
                  <p>Summaries | by Ruchira | Added: 2 weeks ago</p>
                  <div class="document-actions">
                  <div class="left">
                     <button class="star-btn"><i class="bi bi-heart"></i> 5</button>
                  </div>
                  <div class="right">
                      <button class="download-btn"><i class="bi bi-download"></i></button>
                      <button class="view-btn"><i class="bi bi-eye"></i> View</button>
                  </div>
              </div>

              </div>
          </div>

          <!-- Repeat for other documents as needed -->
      </div>
    </div>

    <!-- Discussion Content (Hidden by default) -->
    <div id="discussion-content" class="tab-content hidden">
      <!-- Create a Post -->
      <div class="create-post">
        <h2>Create a post</h2>
        <div class="post-input-row">
          <!-- Avatar -->
          <img 
            src="../assets/images/girl.png" 
            alt="Avatar" 
            class="avatar" 
          />
          <!-- Input Field -->
          <input type="text" placeholder="Ask a question..." />
          <!-- Icons on the right -->
          <div class="input-icons">
            <i class="bi bi-camera"></i>
            <a href="#" class="link-btn" title="Attach Link">
              <i class="bi bi-link"></i>
            </a>
            <i class="bi bi-send-fill"></i>
          </div>
        </div>
      </div>

      <!-- Sample Post Card -->
      <div class="post-card">
        <div class="post-header">
          <img 
            src="../assets/images/girl.png" 
            alt="Avatar" 
            class="avatar"
          />
          <div class="post-user-info">
            <div class="user-top-row">
              <span class="user-name">John Doe</span>
              <span class="user-xp">4</span>
              <span class="time-ago">1 year ago</span>
            </div>
            <div class="user-bottom-row">
              <i class="bi bi-file-earmark-text"></i> 
              <span class="post-category">Category Name</span>
            </div>
          </div>
        </div>
        <div class="post-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac mauris quis sapien ultricies tristique.</p>
        </div>
        <div class="post-footer">
          
          <button class="comment-count" onclick="toggleComments()">
            See all 2 comments
          </button>
        </div>
      <!-- Comments Section (Hidden by default) -->
      <div class="comments-section hidden" id="commentsSection">
          <!-- Comment 1 -->
          <div class="comment">
            <img 
              src="../assets/images/girl.png" 
              alt="Avatar" 
              class="avatar"
            />
            <div class="comment-body">
              <div class="comment-header">
                <span class="comment-author">Alice</span>
                <span class="comment-xp">12</span>
                <span class="comment-time">10 months ago</span>
              </div>
              <p class="comment-text">Nice post! Very informative.</p>
              
            </div>
          </div>

          <!-- Comment 2 -->
          <div class="comment">
            <img 
              src="../assets/images/girl.png" 
              alt="Avatar" 
              class="avatar"
            />
            <div class="comment-body">
              <div class="comment-header">
                <span class="comment-author">Bob</span>
                <span class="comment-xp">2</span>
                <span class="comment-time">8 months ago</span>
              </div>
              <p class="comment-text">Can you explain more on the last topic?</p>
              
            </div>
          </div>

          <!-- Add a Comment -->
          <div class="add-comment">
            <img 
              src="../assets/images/girl.png" 
              alt="Avatar" 
              class="avatar"
            />
            <div class="comment-input-wrapper">
              <input type="text" placeholder="Comment..." />
              <button class="send-btn" title="Send">
                <i class="bi bi-send-fill"></i>
              </button>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/discussion.js"></script>
</body>
</html>