function showTab(tabId, btn) {
    // 1) Remove 'active' class from all tab buttons
    const allTabButtons = document.querySelectorAll('.tab-btn');
    allTabButtons.forEach(button => button.classList.remove('active'));

    // 2) Add 'active' class to the clicked button
    btn.classList.add('active');

    // 3) Hide all tab-content sections
    const allTabContents = document.querySelectorAll('.tab-content');
    allTabContents.forEach(content => {
      content.classList.add('hidden');
      // Remove any animation classes so we can re-trigger them
      content.classList.remove('fade-in');
    });

    // 4) Show the selected tab & add an animation class
    const target = document.getElementById(tabId);
    target.classList.remove('hidden');
    // Add a small delay to ensure 'hidden' is removed before animation
    setTimeout(() => {
      target.classList.add('fade-in');
    }, 10);
  }
  function toggleTab(btn, targetId) {
    // Remove 'active' class from all tab-btn
    const allButtons = document.querySelectorAll('.tab-btn');
    allButtons.forEach(button => button.classList.remove('active'));

    // Add 'active' to clicked button
    btn.classList.add('active');

    // Hide all tab-content
    const allContent = document.querySelectorAll('.tab-content');
    allContent.forEach(content => {
      content.classList.add('hidden');
      content.classList.remove('fade-in');
    });

    // Show the target content & animate
    const target = document.getElementById(targetId);
    target.classList.remove('hidden');
    // Slight delay to re-trigger fade animation
    setTimeout(() => {
      target.classList.add('fade-in');
    }, 50);
  }

  /* Toggle Comments in the Post Card */
  function toggleComments() {
    const comments = document.getElementById('commentsSection');
    comments.classList.toggle('hidden');
    comments.classList.remove('fade-in');
    setTimeout(() => {
      if (!comments.classList.contains('hidden')) {
        comments.classList.add('fade-in');
      }
    }, 50);
  }