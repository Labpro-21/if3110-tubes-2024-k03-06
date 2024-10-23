<?php

include("core/Controller.php");

class JobHistoryController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->role == 'jobseeker') {
            $this->load("jobhistory/history");
        } else {
            header("Location: /home");
        }
    }
}