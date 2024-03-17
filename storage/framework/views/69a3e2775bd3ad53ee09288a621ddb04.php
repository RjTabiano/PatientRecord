<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="<?php echo e(asset('images/logocircle.png')); ?>" />
    
   <title>The Queen's</title>
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
                    <a href="<?php echo e(route('scanner')); ?>">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">OCR Scanner</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('patient.patient_record_history')); ?>">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Patient Records</span>
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
                        <span class="title">Booking</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('staff')): ?>
                <li>
                    <a href="<?php echo e(route('schedule.schedule')); ?>">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Schedule</span>
                    </a>
                </li>
                <?php endif; ?>
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
    <h1 class="heading">Booking List</h1>
    <div class="table_container">
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                  
                </tr>
                </thead>
                <tbody>
                    
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
                    <button onclick="openModal()">
                        Confirm
                    </button>
                    <!-- =========== CONFIRM MODAL  =========  -->
                    <div class="modal" id="myModal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                            <h1>Confirm Booking?</h1>
                            <form method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="status" value="Confirmed"></input>
                                <button type="submit">Save</button>
                            </form>
                    </div>
                    </div>
                    <!-- =========== END CONFIRM MODAL  =========  -->
                    </td>
                    <?php else: ?>
                    <td>
                    <button onclick="openModal()">
                        Unconfirmed
                    </button>
                    <!-- =========== CONFIRM MODAL  =========  -->
                    <div class="modal" id="myModal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                            <h1>Unconfirm Booking?</h1>
                            <form method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="status" value="Unconfirmed"></input>
                                <button type="submit">Save</button>
                            </form>
                    </div>
                    </div>
                    <!-- =========== END CONFIRM MODAL  =========  -->
                    </td>
                    <?php endif; ?>
                    <td>
                    <?php if($booked->status != "Cancelled"): ?>
                                        <button onclick="openModal2()">Cancel</button>
                                        <!-- =========== CANCEL MODAL  =========  -->
                                        <div class="modal2" id="myModal2">
                                            <div class="modal2-content2">
                                                <span class="close2" onclick="closeModal2()">&times;</span>
                                                <h1>Cancel Booking?</h1>
                                                <form method="put" action="<?php echo e(route('confirmBooking', ['booking' => $booked])); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="status" value="Cancelled">
                                                    <button type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- =========== END CANCEL MODAL  =========  -->
                    <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>

    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="<?php echo e(asset('javascript/main.js')); ?>"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\PatientRecord\resources\views/admin/booking.blade.php ENDPATH**/ ?>