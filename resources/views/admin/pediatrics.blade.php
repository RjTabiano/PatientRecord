<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /><link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
    <div class="container">
      <header>Pediatrics Form</header>
      <form method="post" action="{{route('patient.store', ['patient' => $patient])}}" class="form">
        @csrf
        @method('post')
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
        <table border="1">
            <tr>
                <th>Vaccine</th>
                <th>Dose 1</th>
                <th>Dose 2</th>
                <th>Dose 3</th>
                <th>Booster 1</th>
                <th>Booster 2</th>               
            </tr>
            <tr>
                <td><input for="vaccine" name="vaccine" value="Vaccine" type="hidden">Vaccine</input></td>
                <td><input id="vaccine" type="checkbox"></td>
                <td><input id="vaccine" type="checkbox"></td>
                <td><input id="vaccine" type="checkbox"></td>
                <td><input id="vaccine" type="checkbox"></td>
                <td><input id="vaccine" type="checkbox"></td>
            </tr>
            <tr>
                <td>Hepatitis B</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox"></td>
            </tr>
        </table>
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
      </div>
    </div>
    <section class="overlay"></section>
    <script src="{{ asset('javascript/script_dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  </body>
  <script>
        $('#history').summernote({
            placeholder: 'description...',
            tabsize: 2,
            height: 300,
            width: 1000,
            toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
        });
        $('#orders').summernote({
            placeholder: 'description...',
            tabsize: 2,
            height: 300,
            width: 1000,
            toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
        });
    </script>
</html>