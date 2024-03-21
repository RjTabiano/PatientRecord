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
    <h1>OCR Scanner </h1>
        @if(!empty($statusMsg))
            <div class="alert alert-success">{{$statusMsg}}</div>
        @endif
          <label class="doctorid" for="doctor_id">Select Patient Record Type:</label>
          <select name="doctor_id"  id="specialty" class="doctorid1" aria-label="Default select example" style="width: 200px;" onchange="showForm()">
                <option disabled selected required>Select Record Type</option>
                <option  value="pediatrics">Pediatrics</option>
                <option  value="obgyne">Obgyne</option>
            </select>
            <form action="" method="post" accept="image/*" enctype="multipart/form-data">
                @csrf
               @method('PUT')
                  <input type="file" class="form-control" name="image" accept="image/*">
                  <input type="submit" class="custom-button" name="submit" value="Upload">
              </form>

        
        <div id="pediatricsForm" style="display:none;">
          <h2>Pediatrics Form</h2>
          <form method="post" action="" class="form">
            @csrf
            @method('post')
            <div class="column">
            <input type="hidden" name="type" value="Pediatrics"/>
              <div class="input-box">
                <label>Name</label>
                
                <input class="form-control" type="text" name="name" placeholder="Enter Full Name" value="<?php echo !empty($patient['name:']) ? $patient['name:'] : ''; ?>" />
                
              <div class="input-box">
                <label  >Birth Date</label>
                <input class="form-control" type="text" name="birthdate" placeholder="Enter birth date" value="<?php echo !empty($patient['Birthdate:']) ? $patient['Birthdate:'] : ''; ?>"/>
              </div>
            </div>
            <div class="input-box">
                <label  >Age</label>
                <input class="form-control" type="number" name="age" placeholder="Enter Age" required value="<?php echo !empty($patient['Age:']) ? $patient['Age:'] : ''; ?>"/>
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
              <input class="form-control"  type="text" name="address" placeholder="Enter address" value="<?php echo !empty($patient['Address:']) ? $patient['Address:'] : ''; ?>" required />
              <div class="input-box">
                <label  >Mother's Name</label>
                <input class="form-control" type="text" name="mother_name" placeholder="Enter Name" value="<?php echo !empty($patient["Mother's name:"]) ? $patient["Mother's name:"] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label >Phone Number</label>
                <input class="form-control" type="number" name="mother_phone" placeholder="Enter phone number" value="<?php echo !empty($patient['Phone:']) ? $patient['Phone:'] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label  >Father's Name</label>
                <input class="form-control" type="text" name="father_name" placeholder="Enter Name" value="<?php echo !empty($patient["Father's name:"]) ? $patient["Father's name:"] : ''; ?>" required />
              </div>
              <div class="input-box">
                <label  >Phone Number</label>
                <input class="form-control" type="number" name="father_phone"  placeholder="Enter phone number" value="<?php echo !empty($patient['Phone:']) ? $patient['Phone:'] : ''; ?>" required />
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

        <div id="obgyneForm" style="display:none;">
        <header>Obgyne Form</header>
      <form method="post" action="" class="form">
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
            <label class="form-control" >Emergency Contact Number: </label>
            <input class="form-control" type="number" placeholder="" name="emergency_contact_no" required />
          </div>
        </div>
        <div class="form-group">
        <label for="Hypertension">Hypertension</label>
        <input type="checkbox" id="Hypertension" name="Hypertension" value="1">
    </div>

    <div class="form-group">
        <label for="Bronchial_Asthma">Bronchial Asthma</label>
        <input type="checkbox" id="Bronchial_Asthma" name="Bronchial_Asthma" value="1">
    </div>

    <div class="form-group">
        <label for="Thyroid_Disease">Thyroid Disease</label>
        <input type="checkbox" id="Thyroid_Disease" name="Thyroid_Disease" value="1">
    </div>

    <div class="form-group">
        <label for="Heart_Disease">Heart Disease</label>
        <input type="checkbox" id="Heart_Disease" name="Heart_Disease" value="1">
    </div>

    <div class="form-group">
        <label for="Previous_Surgery">Previous Surgery</label>
        <input type="checkbox" id="Previous_Surgery" name="Previous_Surgery" value="1">
    </div>

    <div class="form-group">
        <label for="Allergy">Allergy</label>
        <input type="checkbox" id="Allergy" name="Allergy" value="1">
    </div>

    <div class="form-group">
        <label for="Family_History">Family History</label>
        <input type="text" id="Family_History" name="Family_History">
    </div>

    <h2>Baseline Diagnostics</h2>
    <div class="form-group">
        <label for="CBC_HgB">CBC HgB</label>
        <input type="text" id="CBC_HgB" name="CBC_HgB">
    </div>

    <div class="form-group">
        <label for="plt">Platelet Count (plt)</label>
        <input type="text" id="plt" name="plt">
    </div>

    <div class="form-group">
        <label for="DPT">DPT</label>
        <input type="text" id="DPT" name="DPT">
    </div>

    <div class="form-group">
        <label for="Hct">Hct</label>
        <input type="text" id="Hct" name="Hct">
    </div>

    <div class="form-group">
        <label for="WBC">WBC</label>
        <input type="text" id="WBC" name="WBC">
    </div>

    <div class="form-group">
        <label for="Blood_Type">Blood Type</label>
        <input type="text" id="Blood_Type" name="Blood_Type">
    </div>

    <div class="form-group">
        <label for="FBS">Fasting Blood Sugar (FBS)</label>
        <input type="text" id="FBS" name="FBS">
    </div>

    <div class="form-group">
        <label for="HBsAg">HBsAg</label>
        <input type="text" id="HBsAg" name="HBsAg">
    </div>

    <div class="form-group">
        <label for="VDRL">VDRL</label>
        <input type="text" id="VDRL" name="VDRL">
    </div>

    <div class="form-group">
        <label for="HiV">HIV</label>
        <input type="text" id="HiV" name="HiV">
    </div>

    <div class="form-group">
        <label for="TT">75g OTT</label>
        <input type="text" id="75g_OTT" name="TT">
    </div>

    <div class="form-group">
        <label for="Urinalysis">Urinalysis</label>
        <input type="text" id="Urinalysis" name="Urinalysis">
    </div>

    <div class="form-group">
        <label for="Other">Other</label>
        <input type="text" id="Other" name="Other">
    </div>
    <!-- Obgyne History -->
    <h2>Obgyne History</h2>
    <div class="form-group">
        <label for="gravitiy">Gravitiy</label>
        <input type="text" id="gravitiy" name="gravitiy">
    </div>

    <div class="form-group">
        <label for="parity">Parity</label>
        <input type="text" id="parity" name="parity">
    </div>

    <div class="form-group">
        <label for="OB_score">OB Score</label>
        <input type="text" id="OB_score" name="OB_score">
    </div>

    <div class="form-group">
        <label for="table">Table</label>
        <input type="text" id="table" name="table">
    </div>

    <div class="form-group">
        <label for="Blood_Type">Blood Type</label>
        <input type="text" id="Blood_Type" name="Blood_Type">
    </div>

    <div class="form-group">
        <label for="LMP">LMP</label>
        <input type="text" id="LMP" name="LMP">
    </div>

    <div class="form-group">
        <label for="PMP">PMP</label>
        <input type="text" id="PMP" name="PMP">
    </div>

    <div class="form-group">
        <label for="AOG">AOG</label>
        <input type="text" id="AOG" name="AOG">
    </div>

    <div class="form-group">
        <label for="EDD">EDD</label>
        <input type="text" id="EDD" name="EDD">
    </div>

    <div class="form-group">
        <label for="early_ultrasound">Early Ultrasound</label>
        <input type="text" id="early_ultrasound" name="early_ultrasound">
    </div>

    <div class="form-group">
        <label for="AOG_by_eutz">AOG by EUTZ</label>
        <input type="text" id="AOG_by_eutz" name="AOG_by_eutz">
    </div>

    <div class="form-group">
        <label for="EDD_by_eutz">EDD by EUTZ</label>
        <input type="text" id="EDD_by_eutz" name="EDD_by_eutz">
    </div>

    <div class="form-group">
        <label for="TT1">TT1</label>
        <input type="text" id="TT1" name="TT1">
    </div>

    <div class="form-group">
        <label for="TT2">TT2</label>
        <input type="text" id="TT2" name="TT2">
    </div>

    <div class="form-group">
        <label for="TT3">TT3</label>
        <input type="text" id="TT3" name="TT3">
    </div>

    <div class="form-group">
        <label for="TDAP">TDAP</label>
        <input type="text" id="TDAP" name="TDAP">
    </div>

    <div class="form-group">
        <label for="Flu">Flu</label>
        <input type="text" id="Flu" name="Flu">
    </div>

    <div class="form-group">
        <label for="HPV">HPV</label>
        <input type="text" id="HPV" name="HPV">
    </div>

    <div class="form-group">
        <label for="PCV">PCV</label>
        <input type="text" id="PCV" name="PCV">
    </div>

    <div class="form-group">
        <label for="covid19_brand">COVID-19 Vaccine Brand</label>
        <input type="text" id="covid19_brand" name="covid19_brand">
    </div>

    <div class="form-group">
        <label for="primary">Primary</label>
        <input type="text" id="primary" name="primary">
    </div>

    <div class="form-group">
        <label for="booster">Booster</label>
        <input type="text" id="booster" name="booster">
    </div>
        <button type="submit">Submit</button>
      </form>
        </div>


       
      </div>



    <!-- =========== CONTAINER =========  -->
        

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>