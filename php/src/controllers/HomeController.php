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

    public function guidance1(){
        $this->load("guidance/guidance1");
    }
    public function guidance2(){
        $this->load("guidance/guidance2");
    }
    public function guidance3(){
        $this->load("guidance/guidance3");
    }
    public function guidance4(){
        $this->load("guidance/guidance4");
    }
}