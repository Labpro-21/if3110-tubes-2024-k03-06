const jobCardsContainer = document.querySelector('.joblist');
const searchFilterButton = document.querySelector('.search-button button');

const jobSortSelect = document.getElementById('job-sort');
const jobTypeSelect = document.getElementById('job-type');
const jobLocationSelect = document.getElementById('job-location');

const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const pageButtonsContainer = document.getElementById('page-buttons');

let currentPage = 1;
let totalPages = 0;
let currentJobSort = jobSortSelect.value;
let currentJobType = jobTypeSelect.value;
let currentJobLocation = jobLocationSelect.value;

function fetchJobs() {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', `/lowongan/fetchJobs?page=${currentPage}&job-sort=${currentJobSort}&job-type=${currentJobType}&job-location=${currentJobLocation}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            totalPages = response.totalPages;

            jobCardsContainer.innerHTML = '';

            response.lowonganList.forEach(lowongan => {
                const jobCard = document.createElement('div');
                jobCard.classList.add('job-card');
                jobCard.classList.add('active');
                jobCard.innerHTML = `
                    <p class="job-title">
                        <a href="/lowongan?id=${lowongan.lowongan_id}">
                            ${lowongan.posisi}
                        </a>
                    </p>
                    <p>${lowongan.nama}</p>
                    <p class="job-details">Location: ${lowongan.jenis_lokasi}</p>
                    <p class="job-details">Job Type: ${lowongan.jenis_pekerjaan}</p>
                    <p class="job-details">Last updated: ${lowongan.updated_at}</p>
                `;
                jobCardsContainer.appendChild(jobCard);
            });

            updatePaginationButtons();
        }
    };
    xhr.send();
}

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
            fetchJobs();
        });

        pageButtonsContainer.appendChild(pageButton);
    }
}

function updatePaginationButtons() {
    prevBtn.disabled = currentPage <= 1;
    nextBtn.disabled = currentPage >= totalPages;

    createPageButtons();
}

searchFilterButton.addEventListener('click', function() {
    currentPage = 1;
    currentJobSort = jobSortSelect.value;
    currentJobType = jobTypeSelect.value;
    currentJobLocation = jobLocationSelect.value;
    fetchJobs();
})

prevBtn.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        fetchJobs();
    }
});

nextBtn.addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        fetchJobs();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    fetchJobs();
})

// const jobCards = document.querySelectorAll('.job-card');
// const prevBtn = document.getElementById('prev-btn');
// const nextBtn = document.getElementById('next-btn');
// const pageButtonsContainer = document.getElementById('page-buttons');

// const jobsPerPage = 3;
// let currentPage = 1;
// const totalPages = Math.ceil(jobCards.length / jobsPerPage);



// function updatePagination() {
//     // Update the page number buttons
//     createPageButtons();

//     // Disable/enable prev and next buttons based on the current page
//     prevBtn.disabled = currentPage <= 1;
//     nextBtn.disabled = currentPage >= totalPages;

//     // Hide all job cards first
//     jobCards.forEach((card, _index) => {
//         card.classList.remove('active');
//     });

//     // Show only the jobs for the current page
//     const startIndex = (currentPage - 1) * jobsPerPage;
//     const endIndex = startIndex + jobsPerPage;
//     for (let i = startIndex; i < endIndex; i++) {
//         if (jobCards[i]) {
//             jobCards[i].classList.add('active');
//         }
//     }
// }

// // Event listeners for prev and next buttons
// prevBtn.addEventListener('click', () => {
//     if (currentPage > 1) {
//         currentPage--;
//         updatePagination();
//     }
// });

// nextBtn.addEventListener('click', () => {
//     if (currentPage < totalPages) {
//         currentPage++;
//         updatePagination();
//     }
// });

// // Initialize the first page
// updatePagination();
