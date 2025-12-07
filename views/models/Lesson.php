<?php
class Lesson {
    private $conn;
    private $table = "lessons";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getLessonsByCourse($course_id) {
   
    }
}
