<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    
   <title>The Queen's</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>
                @can('admin')
                <li>
                    <a href="{{route('accounts')}}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Accounts</span>
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{route('scanner')}}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">OCR Scanner</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('patient.patient_record_history')}}">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Patient Records</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('patient.consultations')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Consultation Records</span>
                    </a>
                </li>
                @cannot('doctor')
                <li>
                    <a href="{{route('appointment.appointment')}}">
                        <span class="icon">
                            <ion-icon name="bookmark-outline"></ion-icon>
                        </span>
                        <span class="title">Appointment</span>
                    </a>
                </li>
                @endcannot
                @cannot('doctor')
                <li>
                    <a href="{{route('viewBooking')}}">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Booking</span>
                    </a>
                </li>
                @endcannot
                @cannot('staff')
                <li>
                    <a href="{{route('schedule.schedule')}}">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Schedule</span>
                    </a>
                </li>
                @endcannot
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
    <header>Obgyne Form</header>
      <form method="post" action="{{route('patient.storeObgyne')}}" class="form">
        @csrf
        @method('post')
        <div class="input-box">
          <input type="hidden" name="type" value="Obgyne" />
          <label>Full Name</label>
          <input type="text" placeholder="Enter full name" name="name" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" placeholder="Enter email address" name="email" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Age</label>
            <input type="number" placeholder="Enter Age" name="age" required />
          </div>
        <div class="gender-box">
          <h3>Civil Status</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="civil_status" value="single" checked />
              <label for="check-male">Single</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" value="married" />
              <label for="check-female">Married</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" value="widowed" />
              <label for="check-female">Widowed</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" value="separated" />
              <label for="check-female">Separated</label>
            </div>
          </div>
        </div>
        </div>
        
        <div class="input-box address">
          <label class="form-control" >Address</label>
          <input class="form-control" type="text" placeholder="Enter address" name="address" required />
          <div class="input-box">
            <label class="form-control">Contact Number</label>
            <input class="form-control" type="number" placeholder="Enter contact number" name="contact_number" required />
          </div>
          <div class="input-box">
            <label class="form-control">Occupation</label>
            <input class="form-control" type="text" placeholder="Enter occupation" name="occupation" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Religion</label>
            <input class="form-control" type="text" placeholder="Enter religion" name="religion" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Referred by:</label>
            <input class="form-control" type="text" placeholder="Referred by:" name="referred_by" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Emergency Contact Number</label>
            <input class="form-control" type="number" placeholder="" name="emergency_contact_no" required />
          </div>
        </div>
        <div>
            <input type="checkbox" placeholder="" name="history[]" value="Hypertension"  /> Hypertension
            <input type="checkbox" placeholder="" name="history[]" value="Diabetes"  /> Diabetes
            <input type="checkbox" placeholder="" name="history[]" value="Thyroid Disease"  /> Thyroid Disease
            <input type="checkbox" placeholder="" name="history[]" value="Heart Disease"  /> Heart Disease
            <input type="checkbox" placeholder="" name="history[]" value="Bronchial Ashtma"  /> Bronchial Ashtma
            <input type="checkbox" placeholder="" name="history[]" value="Previous Surgery"  /> Previous Surgery
            <input type="checkbox" placeholder="" name="history[]" value="Allergies"  /> Allergies
            <input type="checkbox" placeholder="" name="history[]" value="Smoker"  /> Smoker
            <input type="checkbox" placeholder="" name="history[]" value="Alcohol"  /> Alcohol
            <input type="checkbox" placeholder="" name="history[]" value="Drugs"  /> Drugs
        </div>
        <button type="submit">Submit</button>
      </form>



    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>