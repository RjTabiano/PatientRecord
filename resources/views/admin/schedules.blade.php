<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    
   <title>The Queen's Clinic</title>
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
                        <span class="title">Add Patient Accounts</span>
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
                        <span class="title">Patient's Schedule</span>
                    </a>
                </li>
                @endcannot
                @cannot('staff')
                <li>
                    <a href="{{route('schedule.schedule')}}">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Doctor's Schedule</span>
                    </a>
                </li>
                @endcannot
                <li>
                    <a href="{{route('feedback')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback</span>
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

    <br>
    <!-- =========== CONTAINER =========  -->
    <h1 class="heading">Doctor's Schedule</h1>
    <button class="modals" onclick="openModal()">
        Add Schedule
    </button> 
        
        <!-- ADD Modal -->
        <div class="modal" id="myModal">
          <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="post" action="{{route('schedule.storeSchedule')}}" class="form">
                        @csrf
                        @method('post')
                        <select name="doctor_id"class="form-select" aria-label="Default select example">
                            <option disabled selected required>Select Doctor</option>
                            @foreach($userDoctors as $doctor)
                                @foreach($doctor->doctor as $doctorer)
                                <option  value="{{$doctorer['id']}}">{{$doctor->name}}
                                </option>
                                @endforeach
                            @endforeach
                        </select>
                        <div class="input-box">
                            <select name="day"class="form-select" aria-label="Default select example">
                                <option disabled selected required>Select Day</option>
                                    <option  value="Monday">Monday</option>
                                    <option  value="Tuesday">Tuesday</option>
                                    <option  value="Wednesday">Wednesday</option>
                                    <option  value="Thursday">Thursday</option>
                                    <option  value="Friday">Friday</option>
                                    <option  value="Saturday">Saturday</option>
                                    <option  value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="start_time">Start Time:</label>
                            <input name="start_time" type="time" />
                            <label for="end_time">End Time:</label>
                            <input name="end_time"type="time" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Schedule</button>
                        </div>
                    </form>
          </div>
        </div>
        <!-- END ADD Modal -->
        <div class="table_container">
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($userDoctors as $doctor)
                    @foreach($doctor->schedule as $schedule)
                <tr>
                    
                    <td>{{$doctor->name}}</td>
                    
                    <td>{{$schedule->start_time}}</td>
                    
                    <td>{{$schedule->end_time}}</td>
                    
                    <td>
                    <button type="button" class="btn btn-success"><a href="{{route('schedule.editSchedule', ['schedule' => $schedule])}}">Edit</a></button>
                    </td>
                    @can('admin')
                    <td>
                            <form method="post" class="cancelForm" action="{{route('schedule.deleteSchedule', ['schedule' => $schedule])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" valaue="Delete" class="save1">Delete</button>
                                </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
                @endforeach
                </tbody>
                   
            </table>



    <!-- =========== CONTAINER ==========  -->

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>
    <script>
  

    document.querySelectorAll(".cancelForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to delete this schedule?");
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

</html>