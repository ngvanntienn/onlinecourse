public function getAllEnrollments() {
        $sql = "SELECT 
                    e.id as enrollment_id,
                    e.enrolled_date,
                    u.id as student_id,
                    u.fullname,
                    u.email,
                    u.avatar,
                    c.title as course_name
                FROM enrollments e
                JOIN users_account u ON e.student_id = u.id


                JOIN courses c ON e.course_id = c.id
                ORDER BY e.enrolled_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeStudent($enrollmentId) {
        $sql = "DELETE FROM enrollments WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $enrollmentId]);
    }