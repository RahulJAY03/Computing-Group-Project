// Enhanced dashboard functionality
document.addEventListener("DOMContentLoaded", () => {
  // Add current date to the dashboard
  const dateElement = document.querySelector('.date');
  if (dateElement) {
    const currentDate = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    dateElement.textContent = currentDate.toLocaleDateString('en-US', options);
  }

  // Session join buttons feedback with improved interaction
  const joinButtons = document.querySelectorAll(".join");
  joinButtons.forEach(button => {
    button.addEventListener("click", function() {
      this.innerHTML = '<i class="fas fa-check"></i> Joined';
      this.classList.add('joined');
      
      // Create and show a toast notification
      showToast("You've joined the session successfully!");
      
      // Prevent multiple clicks
      this.disabled = true;
      
      // Reset after 2 seconds for demo purposes
      setTimeout(() => {
        this.innerHTML = 'Join Now';
        this.classList.remove('joined');
        this.disabled = false;
      }, 3000);
    });
  });

  // View and Download buttons feedback with improved interaction
  const viewButtons = document.querySelectorAll(".view");
  const downloadButtons = document.querySelectorAll(".download");

  viewButtons.forEach(button => {
    button.addEventListener("click", function() {
      const originalText = this.innerHTML;
      this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Opening...';
      
      // Simulate loading
      setTimeout(() => {
        showToast("Note opened in a new tab");
        this.innerHTML = originalText;
      }, 1000);
    });
  });

  downloadButtons.forEach(button => {
    button.addEventListener("click", function() {
      const originalText = this.innerHTML;
      this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
      
      // Simulate download
      setTimeout(() => {
        showToast("Download started");
        this.innerHTML = originalText;
      }, 1200);
    });
  });
  
  // Challenge view details buttons
  const viewDetailButtons = document.querySelectorAll(".view-detail");
  viewDetailButtons.forEach(button => {
    button.addEventListener("click", function() {
      const card = this.closest('.challenge-card');
      const challenger = card.querySelector('.user-info strong').textContent;
      showToast(`Opening challenge details with ${challenger}`);
    });
  });
  
  // New challenge button
  const newChallengeBtn = document.querySelector(".new-challenge-btn");
  if (newChallengeBtn) {
    newChallengeBtn.addEventListener("click", () => {
      showModal("Start a New Challenge", `
        <form id="challenge-form">
          <div class="form-group">
            <label for="challenge-type">Challenge Type</label>
            <select id="challenge-type" class="form-control">
              <option value="quiz">Quiz Challenge</option>
              <option value="project">Project Challenge</option>
              <option value="coding">Coding Challenge</option>
            </select>
          </div>
          <div class="form-group">
            <label for="challenge-opponent">Opponent</label>
            <input type="text" id="challenge-opponent" class="form-control" placeholder="Search for an opponent...">
          </div>
          <div class="form-group">
            <label for="challenge-duration">Duration</label>
            <select id="challenge-duration" class="form-control">
              <option value="24h">24 Hours</option>
              <option value="3d">3 Days</option>
              <option value="1w">1 Week</option>
            </select>
          </div>
          <div class="form-actions">
            <button type="button" class="cancel-btn">Cancel</button>
            <button type="submit" class="submit-btn">Start Challenge</button>
          </div>
        </form>
      `);
      
      // Handle form submission
      const form = document.getElementById('challenge-form');
      if (form) {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          closeModal();
          showToast("New challenge created successfully!");
        });
      }
      
      // Handle cancel button
      const cancelBtn = document.querySelector('.cancel-btn');
      if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
      }
    });
  }
  
  // Handle notifications button
  const notificationBtn = document.querySelector('.notification-btn');
  if (notificationBtn) {
    notificationBtn.addEventListener("click", () => {
      showToast("You have 3 new notifications");
    });
  }
  
  // Add hover effects on cards for better interaction
  const allCards = document.querySelectorAll('.note-card, .session-card, .challenge-card');
  allCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-5px)';
      this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = '';
      this.style.boxShadow = '';
    });
  });
  
  // Helper function to show toast notifications
  function showToast(message) {
    // Check if a toast container exists, if not create one
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
      toastContainer = document.createElement('div');
      toastContainer.className = 'toast-container';
      document.body.appendChild(toastContainer);
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
      <div class="toast-content">
        <i class="fas fa-check-circle toast-icon"></i>
        <span>${message}</span>
      </div>
    `;
    
    // Add to container
    toastContainer.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => {
      toast.classList.add('show');
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => {
        toast.remove();
      }, 300);
    }, 3000);
  }
  
  // Helper function to show modals
  function showModal(title, content) {
    // Create modal backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop';
    
    // Create modal container
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
      <div class="modal-header">
        <h3>${title}</h3>
        <button class="close-modal"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-content">
        ${content}
      </div>
    `;
    
    // Add to body
    document.body.appendChild(backdrop);
    document.body.appendChild(modal);
    
    // Prevent scrolling on body
    document.body.style.overflow = 'hidden';
    
    // Handle close button
    const closeBtn = modal.querySelector('.close-modal');
    if (closeBtn) {
      closeBtn.addEventListener('click', closeModal);
    }
    
    // Allow clicking on backdrop to close
    backdrop.addEventListener('click', closeModal);
    
    // Add animation class
    setTimeout(() => {
      backdrop.classList.add('show');
      modal.classList.add('show');
    }, 10);
  }
  
  // Helper function to close modal
  function closeModal() {
    const backdrop = document.querySelector('.modal-backdrop');
    const modal = document.querySelector('.modal');
    
    if (backdrop && modal) {
      backdrop.classList.remove('show');
      modal.classList.remove('show');
      
      // Remove after animation completes
      setTimeout(() => {
        backdrop.remove();
        modal.remove();
        document.body.style.overflow = '';
      }, 300);
    }
  }
  
  // Add some CSS styles for new components
  addDynamicStyles();
  
  function addDynamicStyles() {
    const styleElement = document.createElement('style');
    styleElement.textContent = `
      /* Toast Notifications */
      .toast-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
      }
      
      .toast {
        background: white;
        color: var(--text-primary);
        border-radius: var(--radius-md);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        padding: 1rem;
        margin-top: 0.75rem;
        display: flex;
        transform: translateX(100%);
        opacity: 0;
        transition: all 0.3s ease;
      }
      
      .toast.show {
        transform: translateX(0);
        opacity: 1;
      }
      
      .toast-content {
        display: flex;
        align-items: center;
      }
      
      .toast-icon {
        color: var(--secondary);
        font-size: 1.25rem;
        margin-right: 0.75rem;
      }
      
      /* Modal Styles */
      .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 900;
        opacity: 0;
        transition: opacity 0.3s ease;
      }
      
      .modal-backdrop.show {
        opacity: 1;
      }
      
      .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        background: white;
        border-radius: var(--radius-lg);
        width: 90%;
        max-width: 500px;
        z-index: 1000;
        opacity: 0;
        transition: all 0.3s ease;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
      
      .modal.show {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
      }
      
      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem;
        border-bottom: 1px solid #e5e7eb;
      }
      
      .modal-header h3 {
        margin: 0;
        color: var(--text-primary);
        font-size: 1.25rem;
      }
      
      .close-modal {
        background: transparent;
        border: none;
        font-size: 1.25rem;
        color: var(--text-tertiary);
        cursor: pointer;
        transition: color 0.2s;
      }
      
      .close-modal:hover {
        color: var(--text-primary);
      }
      
      .modal-content {
        padding: 1.25rem;
      }
      
      /* Form Styles */
      .form-group {
        margin-bottom: 1.25rem;
      }
      
      .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-primary);
      }
      
      .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        color: var(--text-primary);
        transition: border-color 0.2s;
      }
      
      .form-control:focus {
        outline: none;
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
      }
      
      .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.5rem;
      }
      
      .cancel-btn {
        padding: 0.75rem 1rem;
        background: transparent;
        border: 1px solid #e5e7eb;
        border-radius: var(--radius-md);
        font-weight: 500;
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.2s;
      }
      
      .cancel-btn:hover {
        background: #f3f4f6;
      }
      
      .submit-btn {
        padding: 0.75rem 1.25rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
      }
      
      .submit-btn:hover {
        background: var(--primary-dark);
      }
      
      /* Button States */
      .join.joined {
        background: var(--secondary-light);
      }
    `;
    document.head.appendChild(styleElement);
  }
});