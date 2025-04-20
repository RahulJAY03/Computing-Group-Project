document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab");
  const container = document.querySelector(".card-group");

  // Attach event listeners for tab filtering
  tabButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      tabButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      const tabType = btn.getAttribute("data-status").toLowerCase();
      const cards = document.querySelectorAll(".card");

      cards.forEach(card => {
        const show = tabType === "all" || card.classList.contains(tabType);
        card.style.display = show ? "block" : "none";
      });
    });
  });

  // Capitalize first letter
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  // Fetch challenges from the backend
  function fetchChallenges() {
    fetch('../api/challenge/get_challenges.php')
      .then(response => response.json())
      .then(data => {
        console.log("Challenges Data:", data);  // Debugging: Check the challenges data in the console
        if (data.success) {
          renderChallenges(data.challenges);
        } else {
          alert("Error fetching challenges: " + (data.message || 'Unknown error'));
        }
      })
      .catch(error => {
        console.error("Error fetching challenges:", error);
        alert("Failed to load challenges.");
      });
  }

  // Render challenge cards
  // Ensure all statuses are handled and displayed
  function renderChallenges(challenges) {
    const baseUrl = "http://localhost/cgp-sara/";
    const challengeCards = challenges.map(challenge => {
      const cardClass = challenge.status.toLowerCase();
      const challenger = challenge.challenger;
      const challenged = challenge.challenged;
  
      const challengerImage = challenger.profile_image.startsWith('http')
        ? challenger.profile_image
        : baseUrl + challenger.profile_image;
  
      const challengedImage = challenged.profile_image.startsWith('http')
        ? challenged.profile_image
        : baseUrl + challenged.profile_image;
  
      let timeLeft = '';
      let challengeStatus = challenge.status;
      let winnerId = null;
  
      if (challenge.startTime) {
        const startTime = new Date(parseInt(challenge.startTime.$date.$numberLong));
        const now = new Date();
  
        const endTime = new Date(startTime);
        endTime.setDate(startTime.getDate() + 1);
  
        if (now >= endTime) {
          challengeStatus = 'completed';
          timeLeft = 'Time’s up';
  
          // Determine winner
          if (challenger.xp > challenged.xp) {
            winnerId = challenger._id;
          } else if (challenged.xp > challenger.xp) {
            winnerId = challenged._id;
          }
  
          // Update challenge with winnerId if not already set
          if (!challenge.winnerId && winnerId) {
            fetch('../api/challenge/update_winner.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                challengeId: challenge._id,
                winnerId: winnerId
              })
            })
            .then(res => res.json())
            .then(data => {
              if (!data.success) {
                console.error("Winner update failed:", data.message);
              }
            })
            .catch(err => {
              console.error("Error updating winner:", err);
            });
          }
  
        } else {
          const timeDiff = endTime - now;
          const hoursLeft = Math.floor(timeDiff / (1000 * 60 * 60));
          const minutesLeft = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
          timeLeft = `${hoursLeft}h ${minutesLeft}m`;
        }
      }
  
      let formattedStartDate = 'Not started';
      if (challenge.startTime) {
        const startDate = new Date(parseInt(challenge.startTime.$date.$numberLong));
        if (!isNaN(startDate)) {
          formattedStartDate = startDate.toLocaleDateString();
        } else {
          formattedStartDate = 'Invalid Date';
        }
      }
  
      return `
        <div class="card ${challengeStatus.toLowerCase()}">
          <span class="status ${challengeStatus.toLowerCase()}">${capitalizeFirstLetter(challengeStatus)}</span>
          <div class="top-line">
              <div class="player">
                  <img src="${challengerImage}" alt="${challenger.name}" />
                  <p>${challenger.name} <span class="xp">${challenger.xp} XP</span></p>
              </div>
              <div class="vs-container">
                  <span class="vs">VS</span>
              </div>
              <div class="player">
                  <img src="${challengedImage}" alt="${challenged.name}" />
                  <p>${challenged.name} <span class="xp">${challenged.xp} XP</span></p>
              </div>
          </div>
          <div class="info">
              ${challengeStatus === 'active' ? `<div class="time-left"><i class="fas fa-hourglass-half"></i><p>Time Left: ${timeLeft}</p></div>` : ''}
              <div class="start-date">
                  <i class="far fa-calendar-alt"></i>
                  <p>Started: ${formattedStartDate}</p>
              </div>
          </div>
          ${challengeStatus === 'pending' ? `
              <div class="actions">
                  <button class="accept-btn" data-id="${challenge._id}">Accept</button>
                  <button class="decline-btn" data-id="${challenge._id}">Decline</button>
              </div>
          ` : ''}
          <div class="progress-container">
              <div class="progress-label">
                  <span>Progress</span>
                  <span>80%</span>
              </div>
              <div class="progress-bar">
                  <div style="width: 80%;"></div>
              </div>
          </div>
        </div>
      `;
    }).join('');
  
    container.innerHTML = challengeCards;
  
    document.querySelectorAll(".accept-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const challengeId = btn.dataset.id;
        handleChallengeAction(challengeId, "accept");
      });
    });
  
    document.querySelectorAll(".decline-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const challengeId = btn.dataset.id;
        handleChallengeAction(challengeId, "decline");
      });
    });
  }
  

  // Handle accept/decline
  function handleChallengeAction(challengeId, action) {
    console.log({ challengeId, action }); // DEBUG
    fetch('../api/challenge/respond_challenge.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ challengeId, action })
    })
    .then(res => res.json())
    .then(data => {
      console.log('Response from action:', data);  // Debugging: Log action response
      if (data.success) {
        alert(`Challenge ${action}ed successfully!`);
        fetchChallenges(); // Refresh challenges
      } else {
        alert("Error: " + (data.message || "Something went wrong"));
      }
    })
    .catch(err => {
      console.error("Error:", err);
      alert("Failed to perform action.");
    });
  }

  // Load initial data
  fetchChallenges();
});
