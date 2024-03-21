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
                        <ion-icon name="scan-circle-outline"></ion-icon>
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
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="nav-link" 
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                        <span class="icon"><ion-icon name="bx bx-log-out icon"></ion-icon></span>
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
    <h1 class="heading">Appointments</h1><br>
    <button class="modals" onclick="openModal()">
        Add
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
                    <th scope="col">Action</th>
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
                    <button onclick="openModal2()">
                        Delete
                    </button>
                        <!-- DELETE Modal -->
                        <div class="modal2" id="myModal2">
                          <div class="modal2-content2">
                            <span class="close2" onclick="closeModal2()">&times;</span>
                            <form method="post" action="{{route('schedule.deleteSchedule', ['schedule' => $schedule])}}" class="form">
                                    @csrf
                                    @method('delete')
                                <div class="modal-footer">
                                    <button type="submit" valaue="Delete" class="btn btn-primary">Delete</button>
                                </div>
                                </form>
                          </div>
                        </div>
        <!-- END DELETE MODAL -->
                    </td>
                </tr>
                @endforeach
                @endforeach
                </tbody>
                   
            </table>



    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>