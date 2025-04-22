document.addEventListener("DOMContentLoaded", () => {
  // Helper function to capitalize the first letter of a string
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  const tabButtons = document.querySelectorAll(".tab");
  const container = document.querySelector(".card-group");

  // Flag to prevent multiple event listener attachments and repeated fetches
  if (!window.eventListenersAttached) {
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

    // Set the flag to prevent multiple attachment of listeners
    window.eventListenersAttached = true;
  }

  let challengesFetched = false;

  // Debounced version of fetchChallenges to prevent repeated network calls
  let debounceFetchChallenges = (function () {
    let timeout;
    return function () {
      clearTimeout(timeout);
      timeout = setTimeout(fetchChallenges, 300); // Adjust delay as needed
    };
  })();

  function fetchChallenges() {
    if (challengesFetched) return;  // Prevent duplicate fetch calls

    challengesFetched = true;
    console.log("Fetching challenges...");

    fetch('../api/challenge/get_challenges.php')
      .then(response => {
        console.log('Response Status:', response.status);  // Log the response status
        if (!response.ok) {
          throw new Error('Failed to fetch challenges: ' + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        console.log('Data received:', data);  // Log the response data
        if (data.success) {
          renderChallenges(data.challenges);
          attachButtonEvents();
        } else {
          console.error('Error in response data:', data.message || 'Unknown error');
          alert("Error fetching challenges: " + (data.message || 'Unknown error'));
        }
      })
      .catch(error => {
        console.error("Error fetching challenges:", error);  // Log the full error object
        alert("Failed to load challenges: " + (error.message || error));
      })
      .finally(() => {
        challengesFetched = false;  // Reset flag once fetching is complete
      });
  }

  // Moved the winner details inside each card
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
      let winnerDisplay = '';

      if (challenge.status === 'completed' && challenge.winner) {
        const winner = challenge.winner;
        const winnerImage = winner.profile_image.startsWith('http')
          ? winner.profile_image
          : baseUrl + winner.profile_image;

        winnerDisplay = `
          <div class="winner">
            <p><strong>Winner:</strong></p>
            <img src="${winnerImage}" alt="${winner.name}" />
            <p>${winner.name} <span class="xp">${winner.xp} XP</span></p>
          </div>
        `;
      }

      if (challenge.startTime) {
        const startTime = new Date(parseInt(challenge.startTime.$date.$numberLong));
        const now = new Date();
        const endTime = new Date(startTime);
        endTime.setHours(startTime.getHours() + 24);


        if (now >= endTime && challenge.status !== 'completed') {
          challengeStatus = 'completed';
          timeLeft = 'Time’s up';
          fetch('../api/challenge/complete_challenge.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `challengeId=${challenge._id}`
          })
          .then(res => res.json())
          .then(result => {
            if (result.success) {
              console.log('Challenge marked as completed');
              debounceFetchChallenges(); // Use debounced version
            } else {
              console.error(result.message || 'Failed to complete challenge');
            }
          })
          .catch(err => console.error('Error:', err));
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
        }
      }

      return `
        <div class="card ${challengeStatus.toLowerCase()}" data-id="${challenge._id}">
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
            <div class="action-buttons">
              <button class="btn btn-success btn-sm accept-btn" data-id="${challenge._id}">Accept</button>
              <button class="btn btn-danger btn-sm decline-btn" data-id="${challenge._id}">Decline</button>
            </div>
          ` : ''}
          ${winnerDisplay}
        </div>
      `;
    }).join('');

    container.innerHTML = challengeCards;
  }

  function attachButtonEvents() {
    document.querySelectorAll('.accept-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const challengeId = btn.getAttribute('data-id');
        fetch('../api/challenge/accept_challenge.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ challengeId })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            debounceFetchChallenges(); // Use debounced fetch call
          } else {
            alert("Failed to accept challenge.");
          }
        });
      });
    });

    document.querySelectorAll('.decline-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const challengeId = btn.getAttribute('data-id');
        fetch('../api/challenge/decline_challenge.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ challengeId })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            debounceFetchChallenges(); // Use debounced fetch call
          } else {
            alert("Failed to decline challenge.");
          }
        });
      });
    });
  }

  // Fetch winner details and display them
  function fetchWinnerDetails(winnerId) {
    fetch(`../api/challenge/get_user.php?id=${winnerId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to fetch winner details: ' + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          const winner = data.user;
          const winnerDetails = `
            <div class="winner-details">
              <p><strong>Winner:</strong></p>
              <img src="${winner.profile_image}" alt="${winner.name}" />
              <p>${winner.name} <span class="xp">${winner.xp} XP</span></p>
            </div>
          `;
          document.querySelector(".winner-container").innerHTML = winnerDetails;
        } else {
          console.error('Error in winner response data:', data.message || 'Unknown error');
        }
      })
      .catch(error => {
        console.error("Error fetching winner details:", error);
      });
  }

 

  // Load on page start
  debounceFetchChallenges();  // Debounced fetch on page load
});
