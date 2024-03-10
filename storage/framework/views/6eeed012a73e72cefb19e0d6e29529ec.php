<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="" href="<?php echo e(asset('images/logocircle.png')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <title>The Queen's</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    
  </head>
  <!-- Hello world-->
  <body>
    <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">Admin Panel</span>
      </div>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">Admin Panel</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="<?php echo e(route('patient.patient-record')); ?>" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Home</span>
              </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
            <li class="list">
              <a href="<?php echo e(route('staff.staff')); ?>" class="nav-link">
                <i class="bx bx-bar-chart-alt-2 icon"></i>
                <span class="link">Staffs</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo e(route('doctor.doctor')); ?>" class="nav-link">
                <i class="bx bx-bell icon"></i>
                <span class="link">Doctors</span>
              </a>
            </li>
            <?php endif; ?>
            <li class="list">
              <a href="<?php echo e(route('patient.patient_record_history')); ?>" class="nav-link">
                <i class="bx bx-message-rounded icon"></i>
                <span class="link">Patient Records</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo e(route('patient.consultations')); ?>" class="nav-link">
                <i class="bx bx-pie-chart-alt-2 icon"></i>
                <span class="link">Consultation Records</span>
              </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('doctor')): ?>
            <li class="list">
              <a href="<?php echo e(route('appointment.appointment')); ?>" class="nav-link">
                <i class="bx bx-heart icon"></i>
                <span class="link">Appointment</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('doctor')): ?>
            <li class="list">
              <a href="<?php echo e(route('viewBooking')); ?>" class="nav-link">
                <i class="bx bx-folder-open icon"></i>
                <span class="link">Booking</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('staff')): ?>
            <li class="list">
              <a href="<?php echo e(route('schedule.schedule')); ?>" class="nav-link">
                <i class="bx bx-folder-open icon"></i>
                <span class="link">Schedule</span>
              </a>
            </li>
            <?php endif; ?>
          </ul>

          <div class="bottom-cotent">
            <li class="list">
              <a href="<?php echo e(route('profile.edit')); ?>" class="nav-link">
                <i class="bx bx-cog icon"></i>
                <span class="link"><?php echo e(__('Admin')); ?></span>
              </a>
            </li>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <li class="list">
                   
              <a href="<?php echo e(route('logout')); ?>" class="nav-link" 
              onclick="event.preventDefault();
                    this.closest('form').submit();">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
        <h1>Upload Patient Record</h1>
        <?php if(!empty($statusMsg)): ?>
            <div class="alert alert-success"><?php echo e($statusMsg); ?></div>
        <?php endif; ?>
          <label for="doctor_id">Select Patient Record Type:</label>
          <select name="doctor_id" id="specialty" class="form-select" aria-label="Default select example" onchange="showForm()">
                <option disabled selected required>Select Record Type</option>
                <option  value="pediatrics">Pediatrics</option>
                <option  value="obgyne">Obgyne</option>
            </select>
        <form action="<?php echo e(route('scanner.upload')); ?>" method="post" accept="image/*" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="file" class="form-control" name="image" accept="image/*">
            <input type="submit" class="form-control" name="submit" value="Upload">
        </form>
        
        <div id="pediatricsForm" style="display:none;">
          <h2>Pediatrics Form</h2>
          <form method="post" action="" class="form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>
            <div class="column">
            <input type="hidden" name="type" value="Pediatrics"/>
              <div class="input-box">
                <label>Name</label>
                
                <input class="form-control" type="text" name="name" placeholder="Enter Full Name" value="<?php echo !empty($patient['name:']) ? $patient['name:'] : ''; ?>" />
                
              <div class="input-box">
                <label  >Birth Date</label>
                <input class="form-control" type="text" name="birthdate" placeholder="Enter birth date" value="<?php echo !empty($patient['Birthdate:']) ? $patient['Birthdate:'] : ''; ?>"/>
              </div>
            </div>
            <div class="input-box">
                <label  >Age</label>
                <input class="form-control" type="number" name="age" placeholder="Enter Age" required value="<?php echo !empty($patient['age:']) ? $patient['age:'] : ''; ?>"/>
              </div>
            <div class="gender-box">
              <h5>Gender</h5>
              <div class="gender-option">
                <div class="gender">
                  <input  type="radio" id="check-male" name="sex" value="male" checked />
                  <label  for="check-male">Male</label>
                </div>
                <div class="gender">
                  <input type="radio" id="check-female" name="sex" value="female" />
                  <label for="check-female">Female</label>
                </div>

              </div>
            </div>

            <div class="input-box address">
              <label  >Address</label>
              <input class="form-control"  type="text" name="address" placeholder="Enter address" value="<?php echo !empty($patient['address:']) ? $patient['address:'] : ''; ?>" required />
              <div class="input-box">
                <label  >Mother's Name</label>
                <input class="form-control" type="text" name="mother_name" placeholder="Enter Name" value="<?php echo !empty($patient['mother_name:']) ? $patient['mother_name:'] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label >Phone Number</label>
                <input class="form-control" type="number" name="mother_phone" placeholder="Enter phone number" value="<?php echo !empty($patient['mother_phone:']) ? $patient['mother_phone:'] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label  >Father's Name</label>
                <input class="form-control" type="text" name="father_name" placeholder="Enter Name" value="<?php echo !empty($patient['father_name:']) ? $patient['father_name:'] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label  >Phone Number</label>
                <input class="form-control" type="number" name="father_phone"  placeholder="Enter phone number" value="<?php echo !empty($patient['father_phone:']) ? $patient['father_phone:'] : ''; ?>" required />
              </div>
            </div>
            <table class="vaccine_table">
          <tr>
            <th>Vaccine</th>
            <th>Dose 1</th>
            <th>Dose 2</th>
            <th>Dose 3</th>
            <th>Booster 1</th>
            <th>Booster 2</th>
          </tr>
          <tr>
            <td>BCG</td>
            <td><input type="checkbox" name="BCG[]" value="Dose 1"></td>
            <td><input type="checkbox" name="BCG[]" value="Dose 2"></td>
            <td><input type="checkbox" name="BCG[]" value="Dose 3"></td>
            <td><input type="checkbox" name="BCG[]" value="Booster 1"></td>
            <td><input type="checkbox" name="BCG[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Hepatitis B:</td>
            <td><input type="checkbox" name="Hepatitis_B[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Hepatitis_B[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Hepatitis_B[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Hepatitis_B[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Hepatitis B[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>DPT</td>
            <td><input type="checkbox" name="DPT[]" value="Dose 1"></td>
            <td><input type="checkbox" name="DPT[]" value="Dose 2"></td>
            <td><input type="checkbox" name="DPT[]" value="Dose 3"></td>
            <td><input type="checkbox" name="DPT[]" value="Booster 1"></td>
            <td><input type="checkbox" name="DPT[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Polio-OPU</td>
            <td><input type="checkbox" name="Polio_OPU[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Polio_OPU[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Polio_OPU[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Polio_OPU[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Polio_OPU[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Polio-IPU</td>
            <td><input type="checkbox" name="Polio_IPU[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Polio_IPU[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Polio_IPU[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Polio_IPU[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Polio_IPU[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>HiB</td>
            <td><input type="checkbox" name="HiB[]" value="Dose 1"></td>
            <td><input type="checkbox" name="HiB[]" value="Dose 2"></td>
            <td><input type="checkbox" name="HiB[]" value="Dose 3"></td>
            <td><input type="checkbox" name="HiB[]" value="Booster 1"></td>
            <td><input type="checkbox" name="HiB[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>PCV</td>
            <td><input type="checkbox" name="PCV[]" value="Dose 1"></td>
            <td><input type="checkbox" name="PCV[]" value="Dose 2"></td>
            <td><input type="checkbox" name="PCV[]" value="Dose 3"></td>
            <td><input type="checkbox" name="PCV[]" value="Booster 1"></td>
            <td><input type="checkbox" name="PCV[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Measles</td>
            <td><input type="checkbox" name="Measles[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Measles[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Measles[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Measles[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Measles[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Varicella</td>
            <td><input type="checkbox" name="Varicella[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Varicella[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Varicella[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Varicella[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Varicella[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>mmra</td>
            <td><input type="checkbox" name="mmra[]" value="Dose 1"></td>
            <td><input type="checkbox" name="mmra[]" value="Dose 2"></td>
            <td><input type="checkbox" name="mmra[]" value="Dose 3"></td>
            <td><input type="checkbox" name="mmra[]" value="Booster 1"></td>
            <td><input type="checkbox" name="mmra[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Hepatitis A</td>
            <td><input type="checkbox" name="Hepatitis_A[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Hepatitis_A[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Hepatitis_A[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Hepatitis_A[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Hepatitis_A[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Meningo</td>
            <td><input type="checkbox" name="Meningo[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Meningo[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Meningo[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Meningo[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Meningo[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Typhoid</td>
            <td><input type="checkbox" name="Typhoid[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Typhoid[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Typhoid[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Typhoid[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Typhoid[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Jap. Enceph</td>
            <td><input type="checkbox" name="Jap_Enceph[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Jap_Enceph[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Jap_Enceph[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Jap_Enceph[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Jap_Enceph[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>HPV</td>
            <td><input type="checkbox" name="HPV[]" value="Dose 1"></td>
            <td><input type="checkbox" name="HPV[]" value="Dose 2"></td>
            <td><input type="checkbox" name="HPV[]" value="Dose 3"></td>
            <td><input type="checkbox" name="HPV[]" value="Booster 1"></td>
            <td><input type="checkbox" name="HPV[]" value="Booster 2"></td>
          </tr>
          <tr>
            <td>Flu</td>
            <td><input type="checkbox" name="Flu[]" value="Dose 1"></td>
            <td><input type="checkbox" name="Flu[]" value="Dose 2"></td>
            <td><input type="checkbox" name="Flu[]" value="Dose 3"></td>
            <td><input type="checkbox" name="Flu[]" value="Booster 1"></td>
            <td><input type="checkbox" name="Flu[]" value="Booster 2"></td>
          </tr>
          </table>
            <div class="input-box">
              <label for="">P.E./History:</label>
              <textarea name="history" id="history" cols="30" rows="10"></textarea>
            </div>
            <div class="input-box">
              <label for="">Orders:</label>
              <textarea name="orders" id="orders" cols="30" rows="10"></textarea>
            </div>
            <button type="submit">Submit</button>
      </form>
        </div>

        <div id="obgyneForm" style="display:none;">
            <h2>Obgyne Form</h2>
        </div>


       
      </div>
    </div>
    <section class="overlay"></section>
    <script src="<?php echo e(asset('javascript/script_dashboard.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/ocr_scanner.blade.php ENDPATH**/ ?>