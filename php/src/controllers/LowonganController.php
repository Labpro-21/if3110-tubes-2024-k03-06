<?php

include("core/Controller.php");
include_once("config/Database.php");

class LowonganController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['id'])) {
            $_SESSION['lowongan_id'] = $_GET['id'];
            if ($_SESSION['user']->role == 'company') {
                $this->load("detailpage/lowongancomp/lowongancomp");
            } else {
                $this->load("detailpage/lowongan/lowonganjs");
            }
        }
    }
  
    public function fetchJobs() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 3;
            $offset = ($page - 1) * $limit;
            
            $sort = isset($_GET['job-sort']) ? $_GET['job-sort'] :'';
            $jobType = isset($_GET['job-type']) ? $_GET['job-type'] : '';
            $jobLocation = isset($_GET['job-location']) ? $_GET['job-location'] : '';

            // Where 1 = 1 is used to enable appending filters
            $baseQuery = " FROM _lowongan WHERE 1=1";

            // Filters
            if ($jobType) {
                $baseQuery .= " AND jenis_pekerjaan = :jobType";
            }
            if ($jobLocation) {
                $baseQuery .= " AND jenis_lokasi = :jobLocation";
            }

            // Query to fetch jobs with LIMIT and OFFSET
            $jobQuery = "SELECT * " . $baseQuery;
            if ($sort) {
                $jobQuery .= " ORDER BY updated_at " . $sort;
            }
            $jobQuery .= " LIMIT :limit OFFSET :offset";

            // Query to count total results (no LIMIT, no OFFSET, no ORDER BY)
            $countQuery = "SELECT COUNT(*) as total " . $baseQuery;

            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Prepare the job fetching query
            $stmtJob = $conn->prepare($jobQuery);
            $stmtJob->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmtJob->bindParam(':offset', $offset, PDO::PARAM_INT);

            // Prepare the count query
            $stmtCount = $conn->prepare($countQuery);

            // Bind filter parameters to both queries
            if ($jobType) {
                $stmtJob->bindParam(':jobType', $jobType);
                $stmtCount->bindParam(':jobType', $jobType);
            }
            if ($jobLocation) {
                $stmtJob->bindParam(':jobLocation', $jobLocation);
                $stmtCount->bindParam(':jobLocation', $jobLocation);
            }

            // Execute both queries
            $stmtJob->execute();
            $lowonganList = $stmtJob->fetchAll(PDO::FETCH_ASSOC);

            $stmtCount->execute();
            $totalResults = $stmtCount->fetch()['total'];
            $totalPages = ceil($totalResults / $limit);

            // Return the results
            header('Content-Type: application/json');
            echo json_encode([
                'lowonganList' => $lowonganList,
                'totalPages' => $totalPages
            ]);
            exit();
        }
    }
}
