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
                    <form action="<?php echo e(route('searchBooking')); ?>" method="GET">
                        <label>
                            <input type="text" name="search" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>
                <div class="user">
                    
                </div>

        </div>

    <!-- =========== CONTAINER =========  -->
    <br>
    <h1 class="heading">Patient's Schedule</h1>
    <br> 
    <div class="table_container">
        <div class="row">
            <div class="col-12">
            <div style="height: 600px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead >
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Confirmation</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="scrollable-body">
                <?php $__currentLoopData = $booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $book->booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    
                <tr>
                    <td><?php echo e($book->name); ?></td>
                    <td><?php echo e($booked->service); ?></td>
                    <td><?php echo e($booked->date); ?></td>
                    <td><?php echo e($booked->time); ?></td>
                    <td><?php echo e($booked->status); ?></td>
                    <?php if($booked->status == "Unconfirmed" || $booked->status == "Cancelled"): ?>
                    <td>     
                            <form class="confirmationForm" method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="status" value="Confirmed"></input>
                                <button class="but1" type="submit">Confirm</button>
                            </form>
                    </div>
                    <!-- =========== END CONFIRM MODAL  =========  -->
                    </td>
                    <?php else: ?>
                    <td>
                            <form class="unconfirmForm" method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="status" value="Unconfirmed"></input>
                                <button class="uncon1" type="submit">Unconfirm</button>
                            </form>
                    </td>
                    <?php endif; ?>
                    <td>
                    <?php if($booked->status != "Cancelled"): ?>
                                        
                                                <form class="cancelForm" method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="status" value="Cancelled">
                                                    <button class="save1" type="submit">Cancel</button>
                                                </form>
                                            
                    <?php endif; ?>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
</div>
            </div>
        </div>
    </div>
    <!-- =========== CONTAINER =========  -->

    <!-- =========== Scripts =========  -->
    <script src="<?php echo e(asset('javascript/main.js')); ?>"></script>
    <script>
    document.querySelectorAll(".confirmationForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to confirm this booking?");
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll(".unconfirmForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to unconfirm this booking?");
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
    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/booking.blade.php ENDPATH**/ ?>