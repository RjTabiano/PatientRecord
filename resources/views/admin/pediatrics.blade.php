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
                <div class="user">
                    
                </div>

        </div>
        <br><br>
    <!-- =========== CONTAINER =========  -->
    <header class="heading">OCR Scanner (Optional)</header>
    <br>
    <table style="margin: 0 auto;  width:20%">
    <tr>
        <td style="text-align: center;">
            <form id="uploadForm" action="{{ route('scanner.uploadP', ['patient' => $patient]) }}" method="post" accept="image/*" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <input type="file" class="form-control" name="image" accept="image/*">
                <br><br>
                <input type="submit" class="custom-button" name="submit" >
            </form>
        </td>
    </tr>

</table>
   
    <div style="text-align: center;" class="show-result">
      <button class="custom-button" onclick="toggleOCRResult()">Show OCR Result</button>
    </div>


    <div class="OCRresult" style="display: none;">
        <div class="grid-input name">
                <label>&nbspName</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
              </div>
              <div class="grid-input">
                  <label >&nbspBirth Date</label>
                  <input class="input-readonly" type="date" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly/>
              </div>
              <div class="grid-input">
                <label  >&nbspAddress</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly /><br>
              </div>
              <div class="grid-input">
                <label >&nbspMother's Name (Last Name, First Name)</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
              </div>
              <div class="grid-input">
                <label>&nbspMother's Phone Number</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
              </div>
              <div class="grid-input">
                <label>&nbspFather's Name (Last Name, First Name)</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
              </div>
              <div class="grid-input">
                <label>&nbspFather's Phone Number</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
              </div>
            <div class="grid-input">
                <label>Gender</label>
                <input class="input-readonly" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly />
            </div>
            <div class="grid-input">
              <label>Vaccines</label>
              <textarea value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly></textarea>
            </div>
            <div class="grid-input">
              <label>P.E./History</label>
              <textarea value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly></textarea>
            </div>
            <div class="grid-input">
              <label>Orders</label>
              <textarea value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>" readonly></textarea>
            </div>
    </div>



              <br><br>
    <header class="heading">Pediatrics Forms</header>
    <button type="button" class="collapsible">&nbspPatient Information</button>
    <div class="content">
      <form method="post" action="{{ route('patient.store', ['patient' => $patient]) }}" class="gridForm">
          @csrf
          @method('post')
              <br>   
              <div class="grid-input name">
                <input type="hidden" name="type" value="Pediatrics" />
                <label>&nbspName</label>
                <input type="text" placeholder="Enter First Name" name="first_name"  value="{{ isset($pediatrics->first_name) ? $pediatrics->first_name : '' }}" required />
                <input type="text" placeholder="Enter Last Name" name="last_name" value="{{ isset($pediatrics->last_name) ? $pediatrics->last_name : '' }}" style="margin-top: 10px;" required />
              </div>
              <div class="grid-input">
                  <label >&nbspBirth Date</label>
                  <input class=""  type="date" name="birthdate" value="{{ isset($pediatrics->birthdate) ? $pediatrics->birthdate : '' }}" placeholder="Enter birth date"/>
              </div>
              <div class="grid-input">
                <label  >&nbspAddress</label>
                <input class="" type="text" name="address" placeholder="Enter address"  value="{{ isset($pediatrics->address) ? $pediatrics->address : '' }}" required /><br>
              </div>
              <div class="grid-input">
                <label >&nbspMother's Name (Last Name, First Name)</label>
                <input class=""  type="text" name="mother_name" placeholder="Enter Name" value="{{ isset($pediatrics->mother_name) ? $pediatrics->mother_name : '' }}" required />
              </div>
              <div class="grid-input">
                <label>&nbspMother's Phone Number</label>
                <input class="" type="number" name="mother_phone" placeholder="Enter phone number" value="{{ isset($pediatrics->mother_phone) ? $pediatrics->mother_phone : '' }}" required />
              </div>
              <div class="grid-input">
                <label>&nbspFather's Name (Last Name, First Name)</label>
                <input class="" type="text" name="father_name" value="{{ isset($pediatrics->father_name) ? $pediatrics->father_name : '' }}" placeholder="Enter Name" required />
              </div>
              <div class="grid-input">
                <label>&nbspFather's Phone Number</label>
                <input class="" type="number" name="father_phone"  placeholder="Enter phone number" value="{{ isset($pediatrics->father_phone) ? $pediatrics->father_phone : '' }}" required />
              </div>
            <div class="grid-input">
                <label>Gender</label>
                <select name="sex">
                    <option value="male" {{ isset($pediatrics->sex) && $pediatrics->sex === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ isset($pediatrics->sex) && $pediatrics->sex === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
    </div>
    <button type="button" class="collapsible">&nbspVaccine</button>
      <div class="content">
      <table class="vaccine_table">
          <tr>
            <th >Vaccine</th>
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
    <button type="button" class="collapsible">Pediatrics Consultation</button>
    <div class="content">
      <br>
    <div class="span-grid">
          <label for="">P.E./History:</label>
          <textarea name="history" style="width: 100;%" id="history" cols="30" rows="10"></textarea>
        </div>
        <div class="span-grid">
          <label for="">Orders:</label>
          <textarea name="orders" style="width: 100;%" id="orders" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="submit-grid">Submit</button>

        </form>
        
     </div>
    <br>
    


    <!-- ========== CONTAINER ==========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>
    <script>
        function toggleOCRResult() {
            var OCRresult = document.querySelector('.OCRresult');
            if (OCRresult.style.display === "none") {
                OCRresult.style.display = "grid";
            } else {
                OCRresult.style.display = "none";
            }
        }
    </script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>