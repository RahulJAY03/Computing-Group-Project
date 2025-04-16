<?php
require_once '../config/db.php';
session_start();

$userProfilePic = '/Cgp-sara/uploads/profile_pictures/default.png'; // fallback image

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $user = $db->users->findOne(['email' => $email]);

    if ($user && isset($user['profile_image']) && !empty($user['profile_image'])) {
        $userProfilePic = '/Cgp-sara/' . $user['profile_image'];
    }
}

?>


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
<!-- PHP Logic -->
<?php
function getUserInfo($db, $userId) {
    try {
        $user = $db->users->findOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);
        return [
            'name' => $user['fullName'] ?? 'Unknown User',
            'xp' => $user['xp'] ?? 0,
            'avatar' => isset($user['profile_image']) && !empty($user['profile_image'])
                ? '/Cgp-sara/' . $user['profile_image']
                : '/Cgp-sara/uploads/profile_pictures/default.png'
        ];
    } catch (Exception $e) {
        return [
            'name' => 'Unknown User',
            'xp' => 0,
            'avatar' => '/Cgp-sara/uploads/profile_pictures/default.png'
        ];
    }
}

$discussionPosts = $db->discussionPosts->find(['moduleId' => $module['_id']]);
?>

<!-- Discussion Content -->
<div id="discussion-content" class="tab-content" style="display: none;">
    <!-- Create Post Section -->
    <div class="create-post">
        <h2>Create a post</h2>
        <form id="createPostForm">
            <div class="post-input-row">
                <img src="<?= $userProfilePic ?>" alt="Avatar" class="avatar" />
                <input type="text" name="content" placeholder="Ask a question..." required />
                <input type="hidden" name="moduleId" value="<?= $moduleId ?>" />
                <div class="input-icons">
                    <i class="bi bi-camera"></i>
                    <a href="#" class="link-btn" title="Attach Link"><i class="bi bi-link"></i></a>
                    <button type="submit" class="send-btn"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </form>
    </div>

    <!-- Posts Loop -->
    <?php foreach ($discussionPosts as $post): 
        $userInfo = getUserInfo($db, $post['userId']);
    ?>
    <div class="post-card fade-in">
        <div class="post-header">
            <img src="<?= $userInfo['avatar'] ?>" alt="Avatar" class="avatar" />
            <div class="post-user-info">
                <div class="user-top-row">
                    <span class="user-name"><?= htmlspecialchars($userInfo['name']) ?></span>
                    <span class="user-xp"><?= $userInfo['xp'] ?> XP</span>
                    <span class="time-ago">
                        <?= isset($post['created_at']) ? date("F j, Y", $post['created_at']->toDateTime()->getTimestamp()) : 'Date not set' ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="post-content">
            <p><?= htmlspecialchars($post['content'] ?? '') ?></p>
        </div>

        <div class="post-footer">
            <button class="comment-count" onclick="toggleComments(this)">
                See all comments
            </button>
        </div>

        <div class="comments-section hidden">
            <?php
            $comments = $db->discussionComments->find(['postId' => $post['_id']]);
            $hasComments = false;
            foreach ($comments as $comment):
                $hasComments = true;
                $commentUser = getUserInfo($db, $comment['userId']);
            ?>
                <div class="comment">
                    <img src="<?= $commentUser['avatar'] ?>" alt="Avatar" class="avatar" />
                    <div class="comment-body">
                        <div class="comment-header">
                            <span class="comment-author"><?= htmlspecialchars($commentUser['name']) ?></span>
                            <span class="comment-xp"><?= $commentUser['xp'] ?> XP</span>
                            <span class="comment-time">
                                <?= $comment['commentDate']->toDateTime()->format("F j, Y, g:i A") ?>
                            </span>
                        </div>
                        <p class="comment-text"><?= htmlspecialchars($comment['text']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (!$hasComments): ?>
                <p class="no-comments">No comments yet.</p>
            <?php endif; ?>

            <!-- Add Comment Form -->
            <form class="add-comment-form" data-post-id="<?= $post['_id'] ?>">
                <div class="add-comment">
                    <img src="<?= $userProfilePic ?>" alt="Avatar" class="avatar" />
                    <div class="comment-input-wrapper">
                        <input type="text" name="commentText" placeholder="Comment..." required />
                        <button type="submit" class="send-btn" title="Send">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- JS Scripts -->

<!-- 1. Filters (Sorting and Search Filters) -->
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

<!-- 2. Tab Switching (Handles Switching Between Tabs for the Post/Document) -->
<script>
function toggleTab(button, tabId) {
  const tabs = document.querySelectorAll('.tab-content');
  const tabButtons = document.querySelectorAll('.tab-btn');

  // Hide all tabs and remove active class
  tabs.forEach(tab => tab.style.display = 'none');
  tabButtons.forEach(btn => btn.classList.remove('active'));

  // Show selected tab and mark button active
  document.getElementById(tabId).style.display = 'block';
  if (button) button.classList.add('active');
}
</script>

<!-- 3. Handle Post Submission (For Creating New Post) -->
<script>
  const createPostForm = document.getElementById('createPostForm');

  createPostForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Get the form data, including the hidden moduleId
    const formData = new FormData(createPostForm);

    const res = await fetch('/Cgp-sara/api/auth/create_post.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === 'success') {
      alert(data.message);
      createPostForm.reset();
      // Optional: reload posts or append the new post dynamically
      location.href = window.location.pathname + window.location.search + '#discussion';

    } else {
      alert(data.message);
    }
  });
</script>

<!-- 4. Handle Comment Submission -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-comment-form').forEach(form => {
      form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const postId = form.getAttribute('data-post-id');
        const input = form.querySelector('input[name="commentText"]');
        const text = input.value.trim();

        if (!text) return;

        const formData = new FormData();
        formData.append('postId', postId);
        formData.append('text', text);

        const res = await fetch('/Cgp-sara/api/auth/add_comment.php', {
          method: 'POST',
          body: formData
        });

        const data = await res.json();

        if (data.status === 'success') {
          input.value = '';
          alert('Comment added!');
          location.reload(); // Reload the page to show the new comment, or update the post dynamically
        } else {
          alert('Error: ' + data.message);
        }
      });
    });
  });
</script>

<!-- 5. Toggle Comments Visibility (For "See all Comments" Button) -->
<script>
function toggleComments(button) {
  const commentsSection = button.closest('.post-card').querySelector('.comments-section');
  if (commentsSection) {
    commentsSection.classList.toggle('hidden');
    button.textContent = commentsSection.classList.contains('hidden') ? 'See all comments' : 'Hide comments';
  }
}
</script>
<script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
