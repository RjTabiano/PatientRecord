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
                    <a href="{{route('patient.patient-record')}}">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('patient.patient-record')}}">
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSchedule">
        Add
        </button>
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
            
        </div>
        
        <!-- ADD Modal -->
        <div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                            <h5 class="text-center">Day Available</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"  name="day[]"type="checkbox" id="inlineCheckbox1" value="Monday">
                                <label class="form-check-label"  for="inlineCheckbox1">Monday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox2" value="Tuesday">
                                <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox3" value="Wednesday">
                                <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox4" value="Thursday">
                                <label class="form-check-label" for="inlineCheckbox4">Thursday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox5" value="Friday">
                                <label class="form-check-label" for="inlineCheckbox5">Friday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox6" value="Saturday">
                                <label class="form-check-label" for="inlineCheckbox6">Saturday</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="day[]" type="checkbox" id="inlineCheckbox7" value="Sunday">
                                <label class="form-check-label" for="inlineCheckbox7">Sunday</label>
                            </div>
                        </div>
                        <div class="input-box">
                            <label for="start_time">Start Time:</label>
                            <input name="start_time" type="time" />
                            <label for="end_time">End Time:</label>
                            <input name="end_time"type="time" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Schedule</button>
                        </div>
                    </form>
                    </div>
                </div>
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
                    <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSchedule">
                        <i class="far fa-trash-alt">Delete</i>
                        </button>
                        <!-- DELETE Modal -->
                        <div class="modal fade" id="deleteSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('schedule.deleteSchedule', ['schedule' => $schedule])}}" class="form">
                                    @csrf
                                    @method('delete')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" valaue="Delete" class="btn btn-primary">Delete</button>
                                </div>
                                </form>
                            </div>
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