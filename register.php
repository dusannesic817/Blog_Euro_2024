<?php
require_once 'app/database/DbConnection.php';
require_once 'app/classes/User.php';

    $first_name=$last_name=$about=$username=$email="";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $about=$_POST['about'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $password=$_POST['password'];


        $user=new User();

      
        $create=$user->create($first_name,$last_name,$about,$username,$email,$password);

        if($create){
            $_SESSION['succsses_reg'] = "Thank you for registration";
            header("Location: index.php");
            exit();
        }else{
            $_SESSION['unsuccsses_reg'] = "Unsuccssesfull registration";
            header("Location: show_blog.php");
        }
    }
?>
    
    <div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="regModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">      
                <div class="justify-content-end" style="margin-right: 10px; margin-top: 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-5">
                    <img src="public/images/mascot.jpg" width="200px" style="border-radius: 50%;">
                </div>
                <div class="row text-center mb-3">
                    <div class="col-md-12">
                        <h4 style="color: #014675">Please Register</h4>
                    </div>
                </div>
                <form method="POST" class="sing-register-form" action="register.php">
                 
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <input 
                          id="first_name" 
                          type="text" 
                          class="form-control" 
                          placeholder="Name" 
                          name="first_name" 
                          value=<?php echo $first_name?>
                          >

                       
                      </div>
                      <div class="col-md-6">
                          <input 
                          id="surname" 
                          type="text" 
                          class="form-control" 
                          placeholder="Surname" 
                          name="last_name" 
                          value=<?php echo $last_name?>
                          >

                         
                      </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-12">
                    <textarea 
                    class="form-control" 
                    id="about" 
                    name="about" 
                    
                    placeholder="Tell us something about you" 
                    rows="3"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">

                <div class="col-md-12">
                    <input id="username"
                    type="text" 
                    class="form-control" 
                    placeholder="Username" 
                    name="username" 
                    value=<?php echo $username?>
                    >
                </div>
                </div>

                  <div class="row mb-3">

                      <div class="col-md-12">
                          <input id="email"
                           type="email" 
                           class="form-control" 
                           placeholder="Email" 
                           name="email" 
                           value=<?php echo $email?>
                          >                  
                      </div>
                  </div>
            

                  <div class="row mb-3">
                      <div class="col-md-12">
                          <input 
                          id="password" 
                          type="password" 
                          class="form-control" 
                          placeholder="Password"
                          name="password" 
                          >

                         
                      </div>
                  </div>

                  <div class="row mb-3">

                      <div class="col-md-12">
                          <input 
                          id="password-confirm" 
                          type="password" 
                          class="form-control form-control-sm"
                          placeholder="Confirm Password"
                          name="retype" 
                          required autocomplete="retype">
                      </div>
                  </div>
                  <div class="row mb-5 mt-5">
                      <div class="col-md-12">
                        
                      <button type="submit" class="custom-button w-100">Registration</button>
                    
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
