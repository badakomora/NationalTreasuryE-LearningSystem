<?php session_start();?>
<?php require_once('includes/config.php');?>
<?php require_once('admin/includes/sessions.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="tools/styles.css">
    <title>Learn</title>
    <style>
        .dropbtn {
          color: white;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        .dropdown {
          position: relative;
          display: inline-block;
        }
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        .dropdown-content a:hover {
          color: white;
          background-color: #1D2231;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        .dropdown:hover .dropdown-content {
          display: block;
        }
    </style>
</head>
<body>
    
<input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
          <h1>
            <span>Learn</span>
          </h1>
        </div>
        
        <div class="sidebar-menu">
          <ul>
            <li>
              <a href="./?q=AdminDashboard" class="active">
                <span class="fa fa-dashboard"></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropbtn">
                <span class="fa fa-list us"></span>
                <span>Departments <i class="fa fa-caret-down"></i></span>
                <div class="dropdown-content">
                    <a href="./?q=AddDepartment">Add Department</a>
                    <a href="./?q=AdminDepartments">Manage Departments</a>
                </div>
              </a>
            </li>
            <li>
              <a href="./?q=AdminCourses">
                <span class="fa fa-book"></span>
                <span>Courses</span>
              </a>
            </li>
            <!-- <li class="dropdown">
              <a href="#" class="dropbtn">
                <span class="fa fa-sticky-note"></span>
                <span>Lessons <i class="fa fa-caret-down"></i></span>
                <div class="dropdown-content">
                    <a href="./?q=AddLesson">Add Lessons</a>
                    <a href="./?q=Lessons">Manage Lessons</a>
                </div>
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropbtn">
              <span class="fa fa-calendar"></span>
                <span>Assignments <i class="fa fa-caret-down"></i></span>
                <div class="dropdown-content">
                    <a href="./?q=AddAssignment">Add Questions</a>
                    <a href="./?q=Assignments">Manage Assignments</a>
                </div>
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropbtn">
              <span class="fa fa-tasks"></span>
                <span>Examination <i class="fa fa-caret-down"></i></span>
                <div class="dropdown-content">
                    <a href="./?q=AddExamination">Add Questions</a>
                    <a href="./?q=Examination">Manage Examination</a>
                </div>
              </a>
            </li> -->
            <li>
              <a href="./?q=AdminUsers">
                <span class="fa fa-users"></span>
                <span>Users</span>
              </a>
            </li>
            <li>
              <a href="admin/includes/logout.php">
                <span class="fa fa-sign-out"></span>
                <span>Logout</span>
              </a>
            </li>
          </ul>

        </div>
    </div>    
    

    <div class="main-content">
      <header>
        <h2>
          <label for="nav-toggle">
            <span class="fa fa-bars"></span>
          </label>
          <?php echo $_GET['q'];?>
        </h2>

        <div class="search-wrapper">
          <span class="fa fa-search"> </span>
          <form action="" method="post">
                <input type="search" placeholder="Search..." />
          </form>
        </div>

        <div class="user-wrapper">
       <a href="./?q=UpdatePassword&id=<?php echo $_SESSION['user_id']?>"> <img src="tools/files/<?php echo $_SESSION['profile'];?>" width="40px" height="40px" alt="profile-img"></a>
         <div class="">
            <h4><?php echo $_SESSION['name']?></h4>
            <small>
                Admin
            </small>
         </div>
        </div>
      </header>
