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
                <li>
                    <a href="{{route('inactiveUsers')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Inactive Archive</span>
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
                            <select id="timeSelect" name="start_time">
                            <option disabled selected required>Select Start Time</option>
                                <option value="07:00:00">7:00 AM</option>
                                <option value="07:30:00">7:30 AM</option>
                                <option value="08:00:00">8:00 AM</option>
                                <option value="08:30:00">8:30 AM</option>
                                <option value="09:00:00">9:00 AM</option>
                                <option value="09:30:00">9:30 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="11:30:00">11:30 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="12:30:00">12:30 PM</option>
                                <option value="13:00:00">1:00 PM</option>
                                <option value="13:30:00">1:30 PM</option>
                                <option value="14:00:00">2:00 PM</option>
                                <option value="14:30:00">2:30 PM</option>
                                <option value="15:00:00">3:00 PM</option>
                                <option value="15:30:00">3:30 PM</option>
                                <option value="16:00:00">4:00 PM</option>
                                <option value="16:30:00">4:30 PM</option>
                                <option value="17:00:00">5:00 PM</option>
                            </select>
                            <label for="end_time">End Time:</label>
                            <select id="timeSelect" name="end_time">
                            <option disabled selected required>Select End Time</option>
                                <option value="07:00:00">7:00 AM</option>
                                <option value="07:30:00">7:30 AM</option>
                                <option value="08:00:00">8:00 AM</option>
                                <option value="08:30:00">8:30 AM</option>
                                <option value="09:00:00">9:00 AM</option>
                                <option value="09:30:00">9:30 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="11:30:00">11:30 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="12:30:00">12:30 PM</option>
                                <option value="13:00:00">1:00 PM</option>
                                <option value="13:30:00">1:30 PM</option>
                                <option value="14:00:00">2:00 PM</option>
                                <option value="14:30:00">2:30 PM</option>
                                <option value="15:00:00">3:00 PM</option>
                                <option value="15:30:00">3:30 PM</option>
                                <option value="16:00:00">4:00 PM</option>
                                <option value="16:30:00">4:30 PM</option>
                                <option value="17:00:00">5:00 PM</option>
                            </select>
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
                    <th scope="col">Day</th>
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
                    
                    <td>{{$schedule->day}}</td>

                    <td>{{$schedule->start_time}}</td>
                    
                    <td>{{$schedule->end_time}}</td>
                    
                    <td>
                    <a href="{{route('schedule.editSchedule', ['schedule' => $schedule])}}" class="btn btn-md btn-primary"><ion-icon name="create-outline"></ion-icon></a>
                    </td>
                    @can('admin')
                    <td>
                            <form method="post" class="cancelForm" action="{{route('schedule.deleteSchedule', ['schedule' => $schedule])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" valaue="Delete" class="save1"><ion-icon name="trash-outline"></ion-icon></button>
                                </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
                @endforeach
                </tbody>
                   
            </table>
            
            <div id="toaster"></div>

            
            
            
            @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                        showToast("{{ session('error') }}", 'error');
                });

                function showToast(message, type) {
                    const toaster = document.getElementById('toaster');

                    const toast = document.createElement('div');
                    toast.className = 'toast ' + (type === 'error' ? 'toast-error' : 'toast-success');

                    const description = document.createElement('div');
                    description.className = 'description';
                    description.textContent = message;

                    const cancelButton = document.createElement('button');
                    cancelButton.className = 'cancel-button';
                    cancelButton.textContent = 'Dismiss';
                    cancelButton.addEventListener('click', () => hideToast(toast));

                    toast.appendChild(description);
                    toast.appendChild(cancelButton);

                    toaster.appendChild(toast);

                    setTimeout(() => hideToast(toast), 3000); // Hide toast after 3 seconds
                }

                function hideToast(toast) {
                    toast.classList.add('hide');
                    toast.addEventListener('transitionend', () => toast.remove());
                }
            </script>
                @endif

                @if(session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showToast("{{ session('success') }}", 'success');
                        });
                    </script>
                @endif 


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