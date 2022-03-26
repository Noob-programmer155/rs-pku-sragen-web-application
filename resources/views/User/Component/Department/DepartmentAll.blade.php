@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Department</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>department</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="departments section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Departments</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Specialities available at Medicapps</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @for ($i = 0; $i < count($department); $i++)
                      <li class="nav-item" role="presentation">
                          <button class="nav-link @if($i<=0){{'active'}}@endif" id="main-{{$department[$i] -> name}}-tab" data-bs-toggle="tab"
                              data-bs-target="#panel-main-{{$department[$i] -> name}}" type="button" role="tab" aria-controls="panel-main-{{$department[$i] -> name}}"
                              aria-selected="true"><i class="lni {{$department[$i] -> icon}}"></i> {{$department[$i] -> name}}</button>
                      </li>
                    @endfor
                </ul>
                <div class="tab-content" id="myTabContent">
                    @for ($i = 0; $i < count($department); $i++)
                        <div class="tab-pane fade @if($i<=0){{'show active'}}@endif" id="panel-main-{{$department[$i] -> name}}" role="tabpanel"
                            aria-labelledby="main-{{$department[$i] -> name}}-tab">
                            <div class="department-content">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="image w-100">
                                            <a href="/department/{{$department[$i] -> name}}?iddep={{$department[$i] -> id}}">
                                                <img src="/images/departments/{{$department[$i] -> image}}" alt="{{$department[$i] -> name}}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="text">
                                            <h3>{{$department[$i] -> name}}</h3>
                                            <div class="description">{!! $department[$i] -> description !!}</div>
                                            <div class="d-md-flex d-lg-flex d-block align-items-center mt-15">
                                                <div class="rating">
                                                    <h4>Department Rating</h4>
                                                    <div class="container mt-15 mb-0 p-0">
                                                        {{$department[$i] -> rate}}/
                                                        <div class="star">
                                                            <div>
                                                                &nbsp;
                                                                @for($r=1;$r<=4;$r++)
                                                                  @if($r <= $department[$i] -> rate)
                                                                    <i class="lni lni-star-filled full"></i>
                                                                  @elseif($r > ($department[$i] -> rate)+1)
                                                                    <i class="lni lni-star part"></i>
                                                                  @else
                                                                  <i class="lni lni-star full"></i>
                                                                  <i class="lni lni-star-filled part full"
                                                                    style="--range:@php echo substr($department[$i] -> rate,2) . '0%;' @endphp"></i>
                                                                  @endif
                                                                @endfor
                                                            </div>
                                                            &nbsp;4.0<span>&nbsp;&nbsp;<i class="lni lni-user"></i>
                                                            {{$department[$i] -> count}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="flex-grow:1;"></div>
                                                <div class="button">
                                                    <a href="/department/{{$department[$i] -> name}}?iddep={{$department[$i] -> id}}"
                                                      class="btn" style="text-align:center;">View Speciality</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
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
