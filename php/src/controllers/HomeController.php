<?php

include("core/Controller.php");

class HomeController extends Controller {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"]->role == "jobseeker") {
                $this->load("homepage/homejs");
            } else {
                $this->load("homepage/homecomp");
            }
        } else {
            $this->load("login/login");
        }
    }
}