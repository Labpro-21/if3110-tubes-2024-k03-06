<?php

include("core/Controller.php");

class HomeController extends Controller {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["user"]) && $_SESSION["user"]->role == "company") {
            $this->load("homepage/homecomp");
        } else {
            $this->load("homepage/homejs");
        }
    }
}