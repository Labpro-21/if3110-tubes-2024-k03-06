document.addEventListener('DOMContentLoaded', function() {
    fetchJobHistory();
});

function fetchJobHistory() {
    const jobHistoryContainer = document.querySelector('.job-history-container');

    // Panggilan API untuk mendapatkan data pekerjaan
    fetch('/public/views/jobhistory/history.php')  // Ubah ini sesuai dengan endpoint API Anda
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Bersihkan kontainer sebelum menambahkan pekerjaan baru
            jobHistoryContainer.innerHTML = '';

            // Loop untuk menambahkan setiap pekerjaan ke dalam job-history-item
            data.forEach(job => {
                const jobItem = document.createElement('div');
                jobItem.classList.add('job-history-item');

                jobItem.innerHTML = `
                    <div class="job-history-item-title">
                        <h2>${job.posisi}</h2>
                        <p>${job.nama}</p>
                    </div>
                    <div class="job-history-item-description">
                        <p>Location: ${job.jenis_lokasi}</p>
                        <p>Job Type: ${job.jenis_pekerjaan}</p>
                        <p>Last update: ${job.updated_at}</p>
                    </div>
                `;

                // Tambahkan pekerjaan ke dalam kontainer
                jobHistoryContainer.appendChild(jobItem);
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
