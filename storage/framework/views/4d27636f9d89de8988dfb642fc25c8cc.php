<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="<?php echo e(asset('images/logocircle.png')); ?>" />
    
   <title>The Queen's Clinic</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="<?php echo e(route('home')); ?>">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('home')); ?>">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                <li>
                    <a href="<?php echo e(route('accounts')); ?>">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Accounts</span>
                    </a>
                </li>
                <?php endif; ?>

                <li>
                    <a href="<?php echo e(route('patient.patient_record_history')); ?>">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Add Patient Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('patient.consultations')); ?>">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Consultation Records</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('doctor')): ?>
                <li>
                    <a href="<?php echo e(route('appointment.appointment')); ?>">
                        <span class="icon">
                            <ion-icon name="bookmark-outline"></ion-icon>
                        </span>
                        <span class="title">Appointment</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('doctor')): ?>
                <li>
                    <a href="<?php echo e(route('viewBooking')); ?>">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Patient's Schedule</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('staff')): ?>
                <li>
                    <a href="<?php echo e(route('schedule.schedule')); ?>">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Doctor's Schedule</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo e(route('feedback')); ?>">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                <li>
                    <a href="<?php echo e(route('audit')); ?>">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('inactiveUsers')); ?>">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Inactive Archive</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <a href="<?php echo e(route('logout')); ?>" class="nav-link" 
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Logout</span>
                    </a>
                    </form>
                </li>
            </ul>
        </div>

        <!-- ====================== Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <form action="<?php echo e(route('searchUser')); ?>" method="GET">
                        <label>
                            <input type="text" name="search" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>

                <div class="user">
                    
                </div>

        </div>
        <br>
    <!-- =========== CONTAINER =========  -->
    <header class="heading">Add Patient Record</header>
    <br>
     <a href="<?php echo e(route('addPatientView')); ?>"style ="margin-left:2.5%; "class="btn btn-md btn-primary">Add Patient</a>
        <div class="table-wrapper">
            <br><br>
            <p class="instruction">Note: Click user to add Patient Record</p>
            <br>
            <table class="fl-table">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td onclick="window.location='<?php echo e(route('patient.viewRecords', ['user' => $user])); ?>'" style="cursor: pointer;"><?php echo e($user->name); ?></td>
                        <td onclick="window.location='<?php echo e(route('patient.viewRecords', ['user' => $user])); ?>'" style="cursor: pointer;"><?php echo e($user->email); ?></td>
                        <td>
                                <form action="<?php echo e(route('moveInactive', ['user' => $user])); ?>" class="form-button">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="deactivate-button">Deactivate</button>
                                </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
            </table>
        </div>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    <!-- =========== CONTAINER ==========  -->


    <!-- =========== Scripts =========  -->
    <script src="<?php echo e(asset('javascript/main.js')); ?>"></script>
    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/patient_record_history.blade.php ENDPATH**/ ?>