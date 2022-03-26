@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Working Hours</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Work Hours</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="doctor-calendar-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Time Table</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Determine Your Date to Come</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="doctor-calendar-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $r = 0;
                                foreach ($timetable['item'] as $data) {
                                  if(count($data) > 0){
                                    for ($i=0; $i < 8; $i++) {
                                      if($i <= 0){
                                        echo '<tr><td><span class="time">'.$timetable['time'][$r].'</span></td>';
                                      }elseif ($i >= 7) {
                                        echo '</tr>';
                                        break;
                                      }
                                      echo "<td>";
                                      $y = 0;
                                      foreach ($data as $value) {
                                        $u = 0;
                                        foreach ($value as $item) {
                                          if($item -> daystart === $item -> dayend){
                                            if($item -> daystart + $u === $i){
                                              echo "<h3>".$item -> username."</h3>";
                                              echo "<span>".$item -> profession."</span>";
                                            }
                                            $u += 1;
                                          }else{
                                            if($item -> daystart + $y === $i){
                                              echo "<h3>".$item -> username."</h3>";
                                              echo "<span>".$item -> profession."</span>";
                                            }
                                            $y += 1;
                                          }
                                        }
                                      }
                                      echo "</td>";
                                    }
                                  }
                                  $r += 1;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@include('User.Component.Utils.footerHome')

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>

@include('User.Component.Utils.footer')
