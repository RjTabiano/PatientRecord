<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <title>The Queen's</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    
  </head>
  <body>
    <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">Admin Panel</span>
      </div>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">Admin Panel</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="{{route('patient.patient-record')}}" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Home</span>
              </a>
            </li>
            @can('admin')
            <li class="list">
              <a href="{{route('staff.staff')}}" class="nav-link">
                <i class="bx bx-bar-chart-alt-2 icon"></i>
                <span class="link">Staffs</span>
              </a>
            </li>
            <li class="list">
              <a href="{{route('doctor.doctor')}}" class="nav-link">
                <i class="bx bx-bell icon"></i>
                <span class="link">Doctors</span>
              </a>
            </li>
            @endcan
            <li class="list">
              <a href="{{route('patient.patient_record_history')}}" class="nav-link">
                <i class="bx bx-message-rounded icon"></i>
                <span class="link">Patient Records</span>
              </a>
            </li>
            <li class="list">
              <a href="{{route('patient.consultations')}}" class="nav-link">
                <i class="bx bx-pie-chart-alt-2 icon"></i>
                <span class="link">Consultation Records</span>
              </a>
            </li>
            @cannot('doctor')
            <li class="list">
              <a href="{{route('appointment.appointment')}}" class="nav-link">
                <i class="bx bx-heart icon"></i>
                <span class="link">Appointment</span>
              </a>
            </li>
            @endcannot
            @cannot('doctor')
            <li class="list">
              <a href="{{route('viewBooking')}}" class="nav-link">
                <i class="bx bx-folder-open icon"></i>
                <span class="link">Booking</span>
              </a>
            </li>
            @endcannot
            @cannot('staff')
            <li class="list">
              <a href="{{route('schedule.schedule')}}" class="nav-link">
                <i class="bx bx-folder-open icon"></i>
                <span class="link">Schedule</span>
              </a>
            </li>
            @endcannot
          </ul>

          <div class="bottom-cotent">
            <li class="list">
              <a href="{{route('profile.edit')}}" class="nav-link">
                <i class="bx bx-cog icon"></i>
                <span class="link">{{ __('Admin') }}</span>
              </a>
            </li>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li class="list">
                   
              <a href="{{route('logout')}}" class="nav-link" 
              onclick="event.preventDefault();
                    this.closest('form').submit();">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
    <form method="post" action="{{route('appointment.updateAppointment', ['appointment' => $appointment])}}" class="form">
                        @csrf
                        @method('post')
                        <div class="input-box">
                        <label for="doctor_id">Doctor:</label>
                        <select name="doctor_id"class="form-select" aria-label="Default select example">
                            <option disabled selected required>Select Doctor</option>
                            @foreach($doctors as $doctor)
                                @foreach($doctor->doctor as $doctorer)
                                <option  value="{{$doctorer['id']}}">{{$doctor->name}}
                                </option>
                                @endforeach
                            @endforeach
                        </select>
                        </div>
                        <div class="input-box">
                        <label for="patient_id">Patient:</label>
                        <select name="patient_id"class="form-select" aria-label="Default select example">
                            <option disabled selected required>Select Patient</option>
                            @foreach($patients as $patient)
                                <option  value="{{$patient->id}}">{{$patient->name}}
                                </option>
                              
                            @endforeach
                        </select>
                        </div>
                        <div class="input-box">
                            <label class="form-control" for="date">Date:</label>
                            <input class="form-control" name="date" type="date" />                           
                        </div>
                        <div class="input-box">
                            <label class="form-control" for="time">Time:</label>
                            <input class="form-control" name="time" type="time" />
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <section class="overlay"></section>
    <script src="{{ asset('javascript/script_dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
   
</html>