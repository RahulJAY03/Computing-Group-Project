document.addEventListener("DOMContentLoaded", () => {
    const proceedButton = document.getElementById("proceedButton");

    // Silver glow animation
    function addGlow() {
        proceedButton.style.animation = "glowEffect 1.5s infinite alternate";
    }

    // Start glow effect when page loads
    setTimeout(addGlow, 500);

    // Function to create a balloon
    function createBalloon() {
        const balloon = document.createElement('div');
        balloon.classList.add('balloon');
        const x = Math.random() * window.innerWidth;
        const y = window.innerHeight + 100; // Start below the screen
        balloon.style.left = `${x}px`;
        balloon.style.top = `${y}px`;
        balloon.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
        document.body.appendChild(balloon);

        // Remove the balloon after the animation ends
        balloon.addEventListener('animationend', () => {
            balloon.remove();
        });
    }

    // Function to create a party popper
    function createPopper() {
        const popper = document.createElement('div');
        popper.classList.add('popper');
        const x = Math.random() * window.innerWidth;
        const y = Math.random() * window.innerHeight;
        popper.style.left = `${x}px`;
        popper.style.top = `${y}px`;
        popper.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
        document.body.appendChild(popper);

        // Remove the popper after the animation ends
        popper.addEventListener('animationend', () => {
            popper.remove();
        });
    }

    // Function to start the party animations
    function startParty() {
        const numberOfBalloons = 40; // Number of balloons to create
        const numberOfPoppers = 20; // Number of poppers to create

        // Create balloons with a reduced delay
        for (let i = 0; i < numberOfBalloons; i++) {
            setTimeout(() => {
                createBalloon();
            }, i * 300); // Reduced delay (300ms)
        }

        // Create poppers with a reduced delay
        for (let i = 0; i < numberOfPoppers; i++) {
            setTimeout(() => {
                createPopper();
            }, i * 200); // Reduced delay (500ms)
        }
    }

    // Start the party animations when the page loads
    startParty();
});