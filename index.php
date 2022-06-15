<?php
$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';
$content = "";
switch ($view) {

//Admin urls ===================================================================================
case 'AdminDashboard':
    $title = "AdminDashboard";
    $content = 'admin/dahboard.php';
    # code...
    break; 
// departments=====================================
case 'AdminDepartments':
    $title = "AdminDepartments";
    $content = 'admin/departments.php';
    # code...
    break;
case 'CheckReport':
    $title = "CheckReport";
    $content = 'admin/report.php';
    # code...
    break;
case 'AddDepartment':
    $title = "AddDepartment";
    $content = 'admin/forms/add.php';
    # code...
    break;

case 'EditDepartment':
    $title = "EditDepartment";
    $content = 'admin/forms/update.php';
    # code...
    break;
case 'DeleteDepartment':
    $title = "DeleteDepartment";
    $content = 'admin/forms/delete.php';
    # code...
    break;
// courses ==================================================
case 'AdminCourses':
    $title = "AdminCourses";
    $content = 'admin/courses.php';
    # code...
    break;
case 'AdminUsers':
    $title = "AdminUsers";
    $content = 'admin/users.php';
    # code...
    break;
case 'DeleteUser':
    $title = "DeleteUser";
    $content = 'admin/forms/delete.php';
    # code...
    break;
case 'EditRole':
    $title = "EditRole";
    $content = 'admin/forms/update.php';
    # code...
    break;    


















// User urls======================================================================================
    case 'Dashboard':
        $title = "Dashboard";
        $content = 'view/dashboard.php';
        # code...
        break;  
//manage Department
    case 'Departments':
        $title = "Departments";
        $content = 'view/departments.php';
        # code...
        break;
    case 'ViewDepartments':
        $title = "ViewDepartments";
        $content = 'view/viewdepartments.php';
        # code...
        break;
//manage courses
    case 'Courses':
        $title = "Courses";
        $content = 'view/courses.php';
        # code...
        break;
    case 'Mycourses':
        $title = "Mycourses";
        $content = 'view/mycourses.php';
        # code...
        break;
    case 'AddCourse':
        $title = "AddCourse";
        $content = 'view/forms/add.php';
        # code...
        break;
    case 'UpdateCourse':
        $title = "UpdateCourse";
        $content = 'view/forms/update.php';
        # code...
        break;
    case 'DeleteCourse':
        $title = "DeleteCourse";
        $content = 'view/forms/delete.php';
        # code...
        break;
//manage Lessons
    case 'Lessons':
        $title = "Lessons";
        $content = 'view/lessons.php';
        # code...
        break;
    case 'AddLesson':
        $title = "AddLesson";
        $content = 'view/forms/add.php';
        # code...
        break;
    case 'UpdateLesson':
        $title = "UpdateLesson";
        $content = 'view/forms/update.php';
        # code...
        break;
    case 'DeleteLesson':
        $title = "DeleteLesson";
        $content = 'view/forms/delete.php';
        # code...
        break;
        
    case 'ViewLessons':
        $title = "ViewLessons";
        $content = 'view/viewlessons.php';
        # code...
        break;
    case 'Lecture':
        $title = "Lecture";
        $content = 'view/lectureroom.php';
        # code...
        break;
    case 'Attempt':
        $title = "Attempt";
        $content = 'view/forms/checkbox.php';
        # code...
        break;
//manage Assignment
    case 'Assignments':
        $title = "Assignments";
        $content = 'view/assignments.php';
        # code...
        break;
    case 'AssignmentPaper':
        $title = "AssignmentPaper";
        $content = 'view/assignmentpaper.php';
        # code...
        break;
    case 'AddAssignment':
        $title = "AddAssignment";
        $content = 'view/forms/add.php';
        # code...
        break;
    case 'UpdateAssignment':
        $title = "UpdateAssignment";
        $content = 'view/forms/update.php';
        # code...
        break;
    case 'DeleteAssignment':
        $title = "DeleteAssignment";
        $content = 'view/forms/delete.php';
        # code...
        break;
        
    case 'ViewAssignment':
        $title = "ViewAssignment";
        $content = 'view/viewassignments.php';
        # code...
        break;
    case 'ViewQuestions':
        $title = "ViewQuestions";
        $content = 'view/viewquestions.php';
        # code...
        break;
//manage Examination
    case 'Examination':
        $title = "Examination";
        $content = 'view/examination.php';
        # code...
        break;
    case 'AddExamination':
        $title = "AddExamination";
        $content = 'view/forms/add.php';
        # code...
        break;
    case 'UpdateExamination':
        $title = "UpdateExamination";
        $content = 'view/forms/update.php';
        # code...
        break;
    case 'DeleteExamination':
        $title = "DeleteExamination";
        $content = 'view/forms/delete.php';
        # code...
        break;
        
    case 'ViewExamination':
        $title = "ViewExamination";
        $content = 'view/viewexamination.php';
        # code...
        break;
    case 'ExaminationPaper':
        $title = "ExaminationPaper";
        $content = 'view/examinationpaper.php';
        # code...
        break;
    case 'Results':
        $title = "Results";
        $content = 'view/forms/sessionanswer.php';
        # code...
        break;
    case 'CheckResults':
        $title = "CheckResults";
        $content = 'view/checkresults.php';
        # code...
        break;
    case 'FinalResults':
        $title = "FinalResults";
        $content = 'view/forms/finalexam.php';
        # code...
        break;
    case 'Certificate':
        $title = "Certificate";
        $content = 'view/certificate.php';
        # code...
        break;
//Progress
    case 'Progress':
        $title = "Progress";
        $content = 'view/progress.php';
        # code...
        break;
        //Report
    case 'Report':
        $title = "Report";
        $content = 'view/report.php';
        # code...
        break;
//manage Users
    case 'Users':
        $title = "Users";
        $content = 'view/users.php';
        # code...
        break;
    case 'UpdateUser':
        $title = "UpdateUser";
        $content = 'view/forms/update.php';
        # code...
        break;
        
    case 'DeleteUserDetails':
        $title = "DeleteUserDetails";
        $content = 'view/forms/delete.php';
        # code...
        break;

    case 'UpdatePassword':
        $title = "UpdatePassword";
        $content = 'admin/forms/update.php';
        # code...
        break;



        
              
    default:
    $content = 'accounts/index.php';
}
require_once($content);
?>
</div>
<script src="tools/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>