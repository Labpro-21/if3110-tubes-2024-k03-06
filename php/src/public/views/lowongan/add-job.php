<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./public/views/lowongan/add-job.css">
    </head>
    <body>
        <div class="navbar">
            <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
        </div>
        <div class="add-job">
            <div class="container">
                <div class="add-job-form">
                    <h1>Add Job</h1>
                    <p>Job Title</p>
                    <input class="input-box" type="text" id="job-title" placeholder="job title" name="job-title" required>  
                    <p>Job Description</p>
                    <input class="input-box" type="text" id="job-title" placeholder="job title" name="job-title" required>  
                    
                    <p class="filter-section-title">Job Type</p>
                    <div class="filter-group">
                        <select id="job-type">
                            <option value="...">...</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>                            </select>
                    </div>

                    <p class="filter-section-title">Job Location</p>
                    <div class="filter-group">
                        <select id="job-type">
                            <option value="...">...</option>
                            <option value="hybrid">hybrid</option>
                            <option value="on-site">on-site</option>
                            <option value="remote">remote</option>
                        </select>
                    </div>
                </div>            
            </div>
        </div>
    </body>
</html>