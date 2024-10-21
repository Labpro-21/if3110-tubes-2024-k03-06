<?php

include("core/Controller.php");

class IndexController extends Controller {
    public function index() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            header("Location: /home");
        } else {
            $this->load("indexheader/indexheader");
            $this->load("index/index");
        }
    }
}