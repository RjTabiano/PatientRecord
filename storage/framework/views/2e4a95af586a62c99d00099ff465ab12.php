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
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    
                </div>

        </div>
        
    <!-- =========== CONTAINER =========  -->
    <h1 class="heading">Patient Consultation Records</h1>
    <div class="btn_c">
        <a href="<?php echo e(route('patient.addConsultation')); ?>" class="btn btn-md btn-primary">Add Consultation Record</a>
        <table>
            <br><br>
            <thead>
                <br>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created By</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $consultationPediatrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultationPediatric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td scope="row"><?php echo e($patient->name); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($consultationPediatric->created_by); ?></td>
                    <td>
                        <a href="/patient/show/<?php echo e($consultationPediatric->id); ?>" class="btn btn-sucess"><ion-icon name="eye-sharp"></ion-icon></a>
                        </td>
                        <td>
                        <a href="<?php echo e(route('patient.edit_consultationRecord', ['consultationPediatrics' => $consultationPediatric], ['patient' => $patient])); ?>" class="btn btn-info"><ion-icon name="create-outline"></ion-icon></a>
                    </td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                    <td>
                       
                    <form class="confirmationForm" method="post" action="<?php echo e(route('patient.deleteConsultation', ['consultationPediatrics' => $consultationPediatric])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <button class="save1" type="submit" value="Delete" ><ion-icon name="trash-sharp"></ion-icon></button>
                                </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


    <!-- ============ END CONTAINER =========  -->


    <!-- =========== Scripts =========-->
    <script src="<?php echo e(asset('javascript/main.js')); ?>"></script>

    <!-- ====== ionicons ======= -->
    <script>
    document.querySelectorAll(".confirmationForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to delete this booking?");
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll(".cancelForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to cancel this booking?");
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
</script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/consultation_record.blade.php ENDPATH**/ ?>