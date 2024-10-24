const jobCardsContainer = document.querySelector('.joblist');
const searchFilterButton = document.querySelector('.search-button button');

const jobSortSelect = document.getElementById('job-sort');
const jobLocationSelect = document.getElementById('job-location');
const jobTypeSelect = document.getElementById('job-type');

const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const pageButtonsContainer = document.getElementById('page-buttons');

const urlParams = new URLSearchParams(window.location.search);
const searchValue = urlParams.get('search') || '';

let currentPage = 1;
let totalPages = 0;
let currentJobSort = jobSortSelect.value;
let currentJobType = jobTypeSelect.value;
let currentJobLocation = jobLocationSelect.value;

function fetchJobs() {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', `/lowongan/fetchJobs?search=${searchValue}&page=${currentPage}&job-sort=${currentJobSort}&job-type=${currentJobType}&job-location=${currentJobLocation}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            totalPages = response.totalPages;

            jobCardsContainer.innerHTML = '';

            if (response.currentRole == 'company') {
                response.lowonganList.forEach(lowongan => {
                    const jobCardContainer = document.createElement('div');
                    jobCardContainer.classList.add('job-card-container');
                    jobCardContainer.classList.add('active');

                    const jobCardI = document.createElement('div');
                    jobCardI.classList.add('job-card-icon');
                    jobCardI.classList.add('active');
                    jobCardI.innerHTML = `
                        <i class="fas fa-trash-alt" data-id="${lowongan.lowongan_id}"></i>
                        <i class='far fa-edit' data-id="${lowongan.lowongan_id}"></i>
                    `
                    const jobCard = document.createElement('div');
                    jobCard.classList.add('job-card');
                    jobCard.classList.add('active');
                    jobCard.innerHTML = `
                        <p class="job-title">
                            <a href="/lowongan?id=${lowongan.lowongan_id}">
                                ${lowongan.posisi}
                            </a>
                        </p>
                        <p class="job-details">
                            ${lowongan.lokasi} (${lowongan.jenis_lokasi})
                        </p>
                        <p class="job-details">
                            Last Update: ${lowongan.updated_at}
                        </p>
                    `;

                    jobCardContainer.appendChild(jobCardI);
                    jobCardContainer.appendChild(jobCard);
                    jobCardsContainer.appendChild(jobCardContainer);
                });

                resetListeners();
                
            } else {
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
            }
            
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