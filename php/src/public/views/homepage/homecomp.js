const jobCards = document.querySelectorAll('.job-card-container');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const pageButtonsContainer = document.getElementById('page-buttons');

const jobsPerPage = 3;
let currentPage = 1;
const totalPages = Math.ceil(jobCards.length / jobsPerPage);

function createPageButtons() {
    // Clear any existing page buttons
    pageButtonsContainer.innerHTML = '';

    // Create page number buttons dynamically
    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.classList.add('page-number');
        pageButton.textContent = i;

        // Highlight the active page
        if (i === currentPage) {
            pageButton.classList.add('active');
        }

        // Add event listener to each page button
        pageButton.addEventListener('click', () => {
            currentPage = i;
            updatePagination();
        });

        pageButtonsContainer.appendChild(pageButton);
    }
}

function updatePagination() {
    // Update the page number buttons
    createPageButtons();

    // Disable/enable prev and next buttons based on the current page
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    // Hide all job cards first
    jobCards.forEach((card, index) => {
        card.classList.remove('active');
    });

    // Show only the jobs for the current page
    const startIndex = (currentPage - 1) * jobsPerPage;
    const endIndex = startIndex + jobsPerPage;
    for (let i = startIndex; i < endIndex; i++) {
        if (jobCards[i]) {
            jobCards[i].classList.add('active');
        }
    }
}

// Event listeners for prev and next buttons
prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        updatePagination();
    }
});

nextBtn.addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
    }
});

// Initialize the first page
updatePagination();
