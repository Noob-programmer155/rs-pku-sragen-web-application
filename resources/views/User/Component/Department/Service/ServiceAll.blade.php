@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Service</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>service</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="services section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Service</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Pelayanan Kami</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="services-content">
                    @for ($i = 0; $i <= floor($services['count_item']/9); $i++)
                        <div id="<?php echo 'service-container-panel-'.$i; ?>"
                          role="tabpanel" class="row pl-4 pr-4 justify-content-center <?php if($i > 0){echo 'hidden';}?>"
                          aria-labelledby="<?php echo 'service-btn-panel-'.$i; ?>">
                            @for ($h = $i * 9; $h < $services['count_item']; $h++)
                                @if($h < ($i+1) * 9)
                                    <div class="col-lg-4 col-md-6 col-12 p-0">
                                        <div class="single-list custom-border-right wow fadeInUp m-0"
                                            data-wow-delay=".2s">
                                            <img class="shape1" src="/images/service/shape1.svg" alt="#">
                                            <img class="shape2" src="/images/service/shape2.svg" alt="#">
                                            <i class="lni {{$services['data'][$h] -> icon}}"></i>
                                            <h4><a href="/pelayanan/{{$services['data'][$h] -> name}}?idserv={{$services['data'][$h] -> id}}">{{$services['data'][$h] -> name}}</a></h4>
                                            <p>{{$services['data'][$h] -> description_title}}</p>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endfor
                    <nav class="pagination-service">
                      <ul class="pagination">
                        <li class="page-item">
                          <button role="tab" id="previous-btn-page-service" class="page-link">Previous</button>
                        </li>
                        @for($i = 0; $i <= floor($services['count_item']/9); $i++)
                            @if($i <= 0)
                              <li class="page-item"><button id="<?php echo 'service-btn-panel-'.$i; ?>" role="tab" class="page-link item-data active" data-index="{{$i}}" aria-controls="<?php echo 'service-container-panel-'.$i; ?>">{{$i+1}}</button></li>
                            @else
                              <li class="page-item"><button id="<?php echo 'service-btn-panel-'.$i; ?>" role="tab" class="page-link item-data" data-index="{{$i}}" aria-controls="<?php echo 'service-container-panel-'.$i; ?>">{{$i+1}}</button></li>
                            @endif
                        @endfor
                        <li class="page-item">
                          <button role="tab" id="next-btn-page-service" class="page-link">Next</button>
                        </li>
                      </ul>
                    </nav>
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
<!-- Imagesloaded js -->
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('js/isotope.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/serviceAll.js')}}"></script>
@include('User.Component.Utils.footer')
