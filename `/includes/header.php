 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">FAQ</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="mailbox.php" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->

    <!-- Profile Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <!-- <div class="user-panel mt-0 pb-1 mb-1 ">
                <img  src="../file/dist/img/user4.jpg"
                 alt="User Image"
                 style ="height: 40px; 
                 width: auto;
                 margin-top: -4.5px;">
            </div> -->
              <?php
                $profile = mysqli_query($con, "SELECT * FROM user WHERE id='".$_SESSION['id']."'");
                $pic = mysqli_fetch_array($profile);
              ?>
                <div class="pic-holder" style ="width:30px; height:30px; ">
                  <!-- uploaded pic shown here -->
                  <?php if(empty($pic['pic'])){ 
                    echo '<img id="profilePic" style =" border-radius: 100%;"  class="pic" src="../file/dist/img/user1.jpg">';
                  }else{
                    echo '<img id="profilePic" style =" border-radius: 100%;" class="pic" src="../profilePic/'.$pic['pic'].'">';
                  }  ?>
                  
                </div>

                
              
        </a>
        <div class="dropdown-menu ">
            <span 
             class="dropdown-item" 
             style ="text-align: center;  opacity: 0.6;">
                 ADMIN
            </span>
          <div class="dropdown-divider"></div>
            <a href="profile.php" class="dropdown-item">
                <i class="fas fa fa-user mr-2"></i> My Profile
            </a>
            <a href="change-password.php" class="dropdown-item">
                <i class="fas fa fa-lock mr-2"></i> Change Password
            </a>
          <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
        
    </li>  
    </ul>
  </nav>
  <!-- /.navbar -->