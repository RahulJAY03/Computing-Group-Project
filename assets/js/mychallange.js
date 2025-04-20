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

  // Fetch challenges from the backend
  function fetchChallenges() {
    fetch('../api/challenge/get_challenges.php')  // Adjust the API endpoint
      .then(response => response.json())
      .then(data => {
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

 // Render challenge cards dynamically
function renderChallenges(challenges) {
  const baseUrl = "http://localhost/cgp-sara/";  // Replace with your actual base URL
  const challengeCards = challenges.map(challenge => {
    const cardClass = challenge.status.toLowerCase();
    const challenger = challenge.challenger;
    const challenged = challenge.challenged;

    // Only prepend the base URL if the profile image path is relative
    const challengerImage = challenger.profile_image.startsWith('http')
      ? challenger.profile_image
      : baseUrl + challenger.profile_image;

    const challengedImage = challenged.profile_image.startsWith('http')
      ? challenged.profile_image
      : baseUrl + challenged.profile_image;

    return `
      <div class="card ${cardClass}">
        <span class="status ${cardClass}">${capitalizeFirstLetter(challenge.status)}</span>
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
          ${challenge.status === 'active' ? `<div class="time-left"><i class="fas fa-hourglass-half"></i><p>23h 45m left</p></div>` : ''}
          <div class="start-date">
            <i class="far fa-calendar-alt"></i>
            <p>Started: ${new Date(challenge.startTime).toLocaleDateString()}</p>
          </div>
        </div>
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
}

  

  // Capitalize the first letter of the string
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  // Initial fetch challenges when page loads
  fetchChallenges();
});
