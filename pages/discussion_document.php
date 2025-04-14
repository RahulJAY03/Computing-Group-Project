

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
require_once __DIR__ . '/../config/db.php'; // MongoDB connection script

// Check if 'module' parameter is passed in the URL
$moduleName = isset($_GET['module']) ? $_GET['module'] : null;

if ($moduleName) {
    // Fetch the module details based on the module name
    $module = $db->modules->findOne(['moduleName' => $moduleName]);

    if (!$module) {
        // If no module found, redirect or show error
        header("Location: module2.php?category=IT"); // Redirect to IT category page or show error
        exit;
    }
} else {
    // Redirect if module is not found in the URL
    header("Location: module2.php?category=IT");
    exit;
}

?>

  <?php
      include '../includes/navbar.php';  // Navbar include
      include '../includes/sidebar.php'; // Sidebar include
      include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
  ?>
  
  <div class="container">
    <!-- Header Section -->
    <div class="header-section">
            <h2>
                <?php echo htmlspecialchars($module['moduleName']); ?>
            </h2>
        </div>

        

    <!-- Tabs -->
    <div class="tab-section">
      <button class="tab-btn active" onclick="toggleTab(this, 'document-content')">Document</button>
      <button class="tab-btn" onclick="toggleTab(this, 'discussion-content')">Discussion</button>
    </div>

    <?php
use MongoDB\BSON\ObjectId;

$moduleId = (string) $module['_id'];
$notesCursor = $db->notes->find([
    'moduleId' => $moduleId
]);
$notes = iterator_to_array($notesCursor);
?>

<!-- Document Content -->
<div id="document-content" class="tab-content">
  <div class="filter-bar">
    <div class="filters">
      <select id="docTypeFilter">
        <option value="">All Types</option>
        <option value="PDF">PDF</option>
        <option value="DOCX">Document</option>
        <option value="TXT">Image</option>
        <option value="ZIP">ZIP</option>
      </select>

      <select id="languageFilter">
        <option value="">All Languages</option>
        <option value="english">English</option>
        <option value="sinhala">Sinhala</option>
      </select>

      <select id="sortFilter">
        <option value="latest">Sort by Latest</option>
        <option value="oldest">Sort by Oldest</option>
      </select>
    </div>
  </div>

  <div id="notesContainer" class="document-list">
    <?php if (empty($notes)): ?>
      <p>No documents found for this module.</p>
    <?php else: ?>
      <?php foreach ($notes as $note): ?>
        <?php
          $title = htmlspecialchars($note['title']);
          $desc = htmlspecialchars($note['description']);
          $language = strtolower($note['language']);
          $docType = strtoupper($note['doc_type']);
          $filePath = $note['file_path'];
          $uploadDate = $note['created_at']->toDateTime()->format("d M Y");
          $timestamp = $note['created_at']->toDateTime()->getTimestamp();
          $extension = strtolower(pathinfo($note['file_name'], PATHINFO_EXTENSION));
          $iconPath = "../assets/images/default-doc.png";
          $icons = [
            'pdf' => '../assets/images/pdf.png',
            'doc' => '../assets/images/doc.png',
            'docx' => '../assets/images/doc.png',
            'zip' => '../assets/images/zip.png',
            'jpg' => '../assets/images/img.png',
            'jpeg' => '../assets/images/img.png',
            'png' => '../assets/images/img.png',
          ];
          if (array_key_exists($extension, $icons)) {
            $iconPath = $icons[$extension];
          }
        ?>
        <div class="document-item"
             data-type="<?= $docType ?>"
             data-lang="<?= $language ?>"
             data-time="<?= $timestamp ?>">
          <!-- Icon placed top-left corner -->
          <img src="<?= $iconPath ?>" alt="Document Icon" class="doc-img">

          <!-- Title centered on top, bold text -->
          <div class="document-info">
            <h3><a href="<?= $filePath ?>" target="_blank"><?= $title ?></a></h3>
            <p class="desc"><?= $desc ?></p>
            <div class="metadata">
              <span><?= $docType ?> | <?= ucfirst($language) ?></span><br>
              <span>Uploaded on: <?= $uploadDate ?></span>
            </div>
            <div class="document-actions">
              <a href="<?= $filePath ?>" class="download-btn" download><i class="bi bi-download"></i></a>
              <a href="<?= $filePath ?>" target="_blank" class="view-btn"><i class="bi bi-eye"></i> View</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
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

  <script>
document.addEventListener('DOMContentLoaded', function () {
  const docTypeFilter = document.getElementById('docTypeFilter');
  const languageFilter = document.getElementById('languageFilter');
  const sortFilter = document.getElementById('sortFilter');
  const notesContainer = document.getElementById('notesContainer');

  function applyFilters() {
    const docType = docTypeFilter.value;
    const language = languageFilter.value;
    const sort = sortFilter.value;

    const notes = Array.from(notesContainer.querySelectorAll('.document-item'));

    // Filter logic
    notes.forEach(note => {
      const noteType = note.getAttribute('data-type');
      const noteLang = note.getAttribute('data-lang');

      let visible = true;

      if (docType && noteType !== docType) visible = false;
      if (language && noteLang !== language.toLowerCase()) visible = false;

      if (visible) {
        note.style.removeProperty('display'); // restores grid layout
      } else {
        note.style.display = 'none';
      }
    });

    // Sorting logic
    const visibleNotes = notes.filter(note => note.style.display !== 'none');
    visibleNotes.sort((a, b) => {
      const timeA = parseInt(a.getAttribute('data-time'));
      const timeB = parseInt(b.getAttribute('data-time'));
      return sort === 'latest' ? timeB - timeA : timeA - timeB;
    });

    // Append in new order
    visibleNotes.forEach(note => notesContainer.appendChild(note));
  }

  // Listen for filter changes
  docTypeFilter.addEventListener('change', applyFilters);
  languageFilter.addEventListener('change', applyFilters);
  sortFilter.addEventListener('change', applyFilters);
});
</script>



</body>
</html>