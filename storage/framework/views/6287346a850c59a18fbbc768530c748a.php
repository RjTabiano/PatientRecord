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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStaff">
        Add
        </button>
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
        </div>
        <!-- ADD Modal -->
        <div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="<?php echo e(route('staff.storeStaff')); ?>" class="form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('post'); ?>
                    <div class="input-box">
                        <input type="hidden" name="usertype" value="staff"></input>
                        <label for="name">Full Name</label>
                        <input type="text" name="name" placeholder="Enter full name" required />
                    </div>
                    <div class="input-box">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" placeholder="Enter email address" required />
                    </div>
                    <div class="input-box">
                        <label for="role">Role</label>
                        <input type="text" name="role" placeholder="role" required />
                    </div>
                    <div class="input-box">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="password" required />
                    </div>
                    <button type="submit">Submit</button>
                        
                </form>
            
            </div>
        </div>
        </div>
        <!-- END ADD MODAL -->
    
        </div>

        <div class="table_container">
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                <tr>
                    <td><?php echo e($staff->name); ?></td>
                    <?php $__currentLoopData = $staff->staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($child['role']); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td>
                    <button type="button" class="btn btn-success"><a href="<?php echo e(route('staff.editStaff', ['staff' => $staff])); ?>">Edit</a></button>
                    <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStaff">
                        <i class="far fa-trash-alt">Delete</i>
                        </button>
                        <!-- DELETE Modal -->
                        <div class="modal fade" id="deleteStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo e($staff->name); ?>?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?php echo e(route('staff.deleteStaff', ['staff' => $staff])); ?>" class="form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" valaue="Delete" class="btn btn-primary">Delete Doctor</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
        <!-- END DELETE MODAL -->
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                   
            </table>
            </div>
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
</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/staffs.blade.php ENDPATH**/ ?>