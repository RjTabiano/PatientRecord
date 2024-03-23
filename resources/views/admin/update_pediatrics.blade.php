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
                <li>
                    <a href="{{route('feedback')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">feedback</span>
                    </a>
                </li>
                @can('admin')
                <li>
                    <a href="{{route('audit')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Audit Trail</span>
                    </a>
                </li>
                @endcan
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="nav-link" 
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
    <header>Update Pediatrics Form</header>
      
      <form method="post" action="{{route('patient.updatePediatrics', ['patient'=> $patient])}}" class="form">
        @csrf
        @method('put')
        <div class="column">
        <input type="hidden" name="type" value="Pediatrics"/>
          <div class="input-box">
            
            
          <div class="input-box">
            <label  >Birth Date</label>
            <input class="form-control" type="date" name="birthdate" placeholder="Enter birth date"/>
          </div>
        </div>
        <div class="input-box">
            <label  >Age</label>
            <input class="form-control" type="number" name="age" placeholder="Enter Age" required />
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
          <input class="form-control"  type="text" name="address" placeholder="Enter address" required />
          <div class="input-box">
            <label  >Mother's Name</label>
            <input class="form-control" type="text" name="mother_name" placeholder="Enter Name" required />
          </div>
          <div class="input-box">
            <label >Phone Number</label>
            <input class="form-control" type="number" name="mother_phone" placeholder="Enter phone number" required />
          </div>
          <div class="input-box">
            <label  >Father's Name</label>
            <input class="form-control" type="text" name="father_name" placeholder="Enter Name" required />
          </div>
          <div class="input-box">
            <label  >Phone Number</label>
            <input class="form-control" type="number" name="father_phone"  placeholder="Enter phone number" required />
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
       
    </div>
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
      </form>



    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>