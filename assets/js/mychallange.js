document.addEventListener("DOMContentLoaded", () => {
  // Tab functionality
  const tabButtons = document.querySelectorAll(".tab");
  const statusButtons = document.querySelectorAll(".status-tab");
  const cards = document.querySelectorAll(".card");

  // Toggle main tabs (All, Active, Completed, Pending)
  tabButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      // Reset active class
      tabButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      // Get the tab type
      const tabType = btn.textContent.trim().toLowerCase();
      
      // Filter cards based on selected tab
      filterCards(tabType);
    });
  });

  // Filter cards based on the selected tab
  function filterCards(tabType) {
    cards.forEach(card => {
      if (tabType.includes("all")) {
        card.style.display = "block";
      } else if (tabType.includes("active") && card.classList.contains("active")) {
        card.style.display = "block";
      } else if (tabType.includes("completed") && card.classList.contains("completed")) {
        card.style.display = "block";
      } else if (tabType.includes("pending") && card.classList.contains("pending")) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  }

  // Toggle status tabs (Active Challenges, Completed, Pending)
  statusButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      // Reset active class
      statusButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      // Get the status type
      const statusType = btn.textContent.toLowerCase();
      
      // Filter cards based on selected status
      if (statusType.includes("active")) {
        filterCardsByStatus("active");
      } else if (statusType.includes("completed")) {
        filterCardsByStatus("completed");
      } else if (statusType.includes("pending")) {
        filterCardsByStatus("pending");
      }
    });
  });

  // Filter cards based on status
  function filterCardsByStatus(status) {
    cards.forEach(card => {
      if (card.classList.contains(status)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  }

  // Accept / Decline buttons
  const acceptButtons = document.querySelectorAll(".accept");
  const declineButtons = document.querySelectorAll(".decline");

  acceptButtons.forEach(button => {
    button.addEventListener("click", (e) => {
      const card = e.target.closest(".card");
      
      // Add visual feedback
      button.innerHTML = '<i class="fas fa-check"></i> Accepted';
      button.style.pointerEvents = 'none';
      
      // Add animation
      card.style.transition = "all 0.5s ease";
      card.style.backgroundColor = "rgba(46, 204, 113, 0.1)";
      
      // Update card status with animation
      setTimeout(() => {
        card.classList.remove("pending");
        card.classList.add("active");
        
        // Update status badge
        const statusBadge = card.querySelector(".status");
        statusBadge.className = "status active";
        statusBadge.textContent = "Active";
        
        // Remove buttons and add progress and new action button
        const buttonContainer = card.querySelector(".buttons");
        buttonContainer.innerHTML = `
          <div class="progress-container">
            <div class="progress-label">
              <span>Progress</span>
              <span>0%</span>
            </div>
            <div class="progress-bar"><div style="width: 0%;"></div></div>
          </div>
          <button class="card-action-btn active-card-btn"><i class="fas fa-chart-line"></i> View Progress</button>
        `;
        
        // Add event listener to the new button
        const newBtn = buttonContainer.querySelector('.card-action-btn');
        newBtn.addEventListener('click', () => {
          alert("Challenge progress details will be shown here!");
        });
        
        card.style.backgroundColor = "#fff";
      }, 600);
      
      // Update counts
      updateCounts();
    });
  });

  declineButtons.forEach(button => {
    button.addEventListener("click", (e) => {
      const card = e.target.closest(".card");
      
      // Add visual feedback
      button.innerHTML = '<i class="fas fa-times"></i> Declined';
      button.style.pointerEvents = 'none';
      
      // Add animation
      card.style.transition = "all 0.5s ease";
      card.style.backgroundColor = "rgba(231, 76, 60, 0.1)";
      
      // Fade out card
      setTimeout(() => {
        card.style.opacity = "0";
        card.style.transform = "scale(0.8)";
        
        // Remove card after animation
        setTimeout(() => {
          card.remove();
          updateCounts();
        }, 300);
      }, 600);
    });
  });

  // Update counts in status tabs
  function updateCounts() {
    const activeCount = document.querySelectorAll(".card.active").length;
    const completedCount = document.querySelectorAll(".card.completed").length;
    const pendingCount = document.querySelectorAll(".card.pending").length;
    
    document.querySelector(".status-tab:nth-child(1) .count").textContent = activeCount;
    document.querySelector(".status-tab:nth-child(2) .count").textContent = completedCount;
    document.querySelector(".status-tab:nth-child(3) .count").textContent = pendingCount;
  }

  // Card action buttons for active and completed cards
  const actionButtons = document.querySelectorAll(".card-action-btn");
  
  actionButtons.forEach(button => {
    button.addEventListener("click", (e) => {
      const card = e.target.closest(".card");
      
      if (card.classList.contains("active")) {
        // Show active challenge details
        alert("Challenge progress details will be shown here!");
      } else if (card.classList.contains("completed")) {
        // Show completed challenge results
        alert("Challenge results and statistics will be shown here!");
      }
    });
  });

  // New challenge button
  const newChallengeButton = document.querySelector(".new-challenge-btn");
  
  newChallengeButton.addEventListener("click", () => {
    alert("Create new challenge feature will be available soon!");
  });
});
