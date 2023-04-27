<?php
session_start();
require 'connect.php';

if(isset($_POST['save_student']))
{
    $loggedId = $_SESSION['ID'];
    $id = mysqli_real_escape_string($con, $_POST['id']);
//    $faculty_id = mysqli_real_escape_string($con, $_POST['faculty_id']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $marks = mysqli_real_escape_string($con, $_POST['marks']);
//    $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']);
   
    /*$query8 = "INSERT INTO co_average (studentID, courseID,co1, co2, co3, co4)  
    VALUES ('$id','$course','$marks', '$marks', '$marks', '$marks')";*/
      
    $query1 = "INSERT INTO backlogdata (id, faculty_id, semester, section, year, course, marks, timestamp) 
    VALUES ('$id', '$loggedId', '$semester', '$section', '$year', '$course', '$marks', NOW())";
    mysqli_query($con, $query1);

    $query2 = "INSERT INTO student_t (studentID, enrollmentSemester,enrollmentYear )  
    VALUES ('$id','$semester','$year')";
    mysqli_query($con, $query2);

    $query3 = "INSERT INTO registration_t (registrationID, sectionID, studentID)  
    VALUES ('','$section', '$id')";
    
    mysqli_query($con, $query3);
    $regId = mysqli_insert_id($con);

    

    $query6 = "INSERT INTO student_course_performance_t (registrationID ,totalMarksObtained )  
    VALUES ('$regId','$marks')";
    mysqli_query($con, $query6);

    $query4 = "INSERT INTO course_t ( courseID)  
    VALUES ('$course')";
    mysqli_query($con, $query4);

    $query5 = "INSERT INTO section_t (sectionID , semester,courseID, year )  
    VALUES ('$section', '$semester','$course', '$year')";
    mysqli_query($con, $query5);

    
  

  
   /* $query2 = "INSERT INTO student_t (studentID, enrollmentSemester,enrollmentYear,programID,departmentID )  
    VALUES ('$id','$semester','$year',88,'sss')";
    $query3 = "INSERT INTO registration_t (registrationID, sectionID, studentID)  
    VALUES ('','$section', '$id')";
    $query4 = "INSERT INTO answer_t (answerNum, markObtained,registrationID,examID )  
    VALUES (75, '$marks',LAST_INSERT_ID(), 75)";
    $query5 = "INSERT INTO question_t (examID, questionNum,coNum, courseID, markPerQuestion)  
    VALUES (75, 75,5,'$course', 20)";
    $query6 = "INSERT INTO plo_t (ploNum, programID)  
    VALUES (5,501)";
    $query7 = "INSERT INTO co_t (coNum, courseID,ploID)  
    VALUES (5,'$course', LAST_INSERT_ID())";*/
  


/*mysqli_query($con, $query7);
mysqli_query($con, $query8);*/

header('location:student-createElma.php');

}

?>


