<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
              <a href="<?php echo e(route('scanner')); ?>" class="nav-link">
                <i class="bx bx-folder-open icon"></i>
                <span class="link">OCR Scanner</span>
              </a>
            </li>
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
    <h1 class="heading">Appointments</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointment">
        Add
    </button>
    <!-- Modal -->
        <div class="modal fade" id="addAppointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form method="post" action="<?php echo e(route('appointment.storeAppointment')); ?>" class="form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('post'); ?>
                        <div class="input-box">
                        <label for="doctor_id">Doctor:</label>
                        <select name="doctor_id"class="form-select" aria-label="Default select example">
                            <option disabled selected required>Select Doctor</option>
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $doctor->doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctorer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option  value="<?php echo e($doctorer['id']); ?>"><?php echo e($doctor->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                        <div class="input-box">
                        <label for="patient_id">Patient:</label>
                        <select name="patient_id"class="form-select" aria-label="Default select example">
                            <option disabled selected required>Select Patient</option>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option  value="<?php echo e($patient->id); ?>"><?php echo e($patient->name); ?>

                                </option>
                              
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                        <div class="input-box">
                            <label  for="date">Date:</label>
                            <input class="form-control" name="date" type="date" />                           
                        </div>
                        <div class="input-box">
                            <label  for="time">Time:</label>
                            <input  class="form-control" name="time" type="time" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Appointment</button>
                        </div>
                            
                    </form>
              </div>
            </div>
          </div>
        </div>
        <!-- END Modal -->
        <div class="table_container">
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Patient Name</th>
                    <th scope="col">With Doctor</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <?php $__currentLoopData = $doctor->appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                <tr>
                    <td><?php echo e($appointment->patient['name']); ?></td>
                    <td><?php echo e($doctor->name); ?></td>
                    <td><?php echo e($appointment->date); ?></td>
                    <td><?php echo e($appointment->time); ?></td>
                    <td>
                    <button type="button" class="btn btn-success"><a href="<?php echo e(route('appointment.editAppointment', ['appointment' => $appointment])); ?>">Edit</a></button>
                    <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSchedule-<?php echo e($appointment); ?>">
                        <i class="far fa-trash-alt">Delete</i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteSchedule-<?php echo e($appointment); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="<?php echo e(route('appointment.deleteAppointment', ['appointment' => $appointment])); ?>" class="form">
                                      <?php echo csrf_field(); ?>
                                      <?php echo method_field('delete'); ?>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" valaue="Delete" class="btn btn-primary">Delete</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END Modal -->
                    </td>
                </tr>
                            
                       
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
    </div>
    <section class="overlay"></section>
    <script src="<?php echo e(asset('javascript/script_dashboard.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
    
</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/appointments.blade.php ENDPATH**/ ?>