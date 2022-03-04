@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Services</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/pelayanan-kami">Service</a></li>
                    <li>{{$serv_name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main class="service-details">
    <div class="container">
        <div class="content">
            <div class="row">
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="service-sidebar">
                        <section class="single-widget search-widget">
                            <h3>Search Here</h3>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </section>
                        <section class="single-widget service-category">
                            <h3>Service Category</h3>
                            <ul>
                              <li>
                                  <a href="/pelayanan-kami">
                                      All Services <i class="lni lni-arrow-right"></i>
                                  </a>
                              </li>
                              @foreach($services[0]['allServices'] as $serv)
                                <li>
                                    <a href="/pelayanan/{{$serv -> name}}?idserv={{$serv -> id}}">
                                        {{$serv -> name}} <i class="lni lni-arrow-right"></i>
                                    </a>
                                </li>
                              @endforeach
                            </ul>
                        </section>
                        <section class="single-widget address">
                            <h3>Department Service</h3>
                            <table>
                              <tbody>
                                <tr>
                                  <td><i class="lni {{$services[0]['department'][0] -> icon}}"></i></td>
                                  <td>{{$services[0]['department'][0] -> name}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-map-marker"></i></td>
                                  <td>{{$services[0]['department'][0] -> location}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-phone"></i></td>
                                  <td>Call Us Now!<br/>
                                    <a href="tel:{{$services[0]['department'][0] -> telp_department}}">{{$services[0]['department'][0] -> telp_department}}</a>
                                  </td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-envelope"></i></td>
                                  <td>Do you have a Question?<br/>
                                    <a href="mailto:{{$global[0] -> description}}">{{$global[0] -> description}}</a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </section>
                    </div>
                </aside>
                <article class="col-lg-8 col-md-12 col-12">
                    <section class="details-content">
                        <div class="thumb">
                            <h1>{{$services[0][0] -> name}}</h1>
                            @if(count($services[0]['image']) > 1)
                              <img src="/images/departments/{{$services[0]['image'][1] -> media}}" alt="{{$services[0][0] -> name}}">
                            @else
                              <img src="/images/departments/{{$services[0]['image'][0] -> media}}" alt="{{$services[0][0] -> name}}">
                            @endif
                        </div>
                        <div class="col-12">
                          <table>
                            <tbody>
                              <tr>
                                <td>Service Icon</td>
                                <td><i class="lni {{$services[0][0] -> icon}}"></i></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="row wow fadeInDown">
                          <div class="col-12">
                            <h2>Description</h2>
                            {!! $services[0][0] -> description !!}
                          </div>
                        </div>
                    </section>
                </article>
            </div>
        </div>
        <article>
            <section class="container image pt-1">
              <div class="row">
                <div class="container-image">
                  <button id="service-detail-images-prev-btn">
                    <svg
                    class="reverse"
                    xmlns="http://www.w3.org/2000/svg"
                    height="4rem"
                    viewBox="0 50 400 250"
                    width="4rem"
                    style="--rotate:-90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
                  </button>
                  <div class="item-image-container-root">
                    <div id="item-image-service-detail-container" class="item-image-container">
                      @for($i=0;$i < count($services[0]['image']);$i++)
                        <div class="item-image">
                          <a href="/images/departments/{{$services[0]['image'][$i] -> media}}" class="glightbox3">
                            <img src="/images/departments/{{$services[0]['image'][$i] -> media}}" alt="{{$serv_name}}">
                          </a>
                        </div>
                      @endfor
                    </div>
                  </div>
                  <button id="service-detail-images-next-btn"><svg
                    class="reverse"
                    xmlns="http://www.w3.org/2000/svg"
                    height="4rem"
                    viewBox="0 50 400 250"
                    width="4rem"
                    style="--rotate:90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
                  </button>
                </div>
              </div>
            </section>
        </article>
    </div>
</main>

@include('User.Component.Utils.footerHome')
<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/glightbox.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/service-details.js')}}"></script>

@include('User.Component.Utils.footer')
