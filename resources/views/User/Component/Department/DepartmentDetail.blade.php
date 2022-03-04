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
                    <li><a href="/departemen-kami">Department</a></li>
                    <li>{{$dep_name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@foreach($department as $dept)
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
                                <h3>Department Category</h3>
                                <ul>
                                  <li>
                                      <a href="/departemen-kami">
                                          All Departments <i class="lni lni-arrow-right"></i>
                                      </a>
                                  </li>
                                    @foreach($department_list as $deplist)
                                    <li>
                                        <a href="/departemen/{{$deplist -> name}}?iddep={{$deplist -> id}}">
                                            {{$deplist -> name}} <i class="lni lni-arrow-right"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </section>
                            <section class="single-widget address">
                                <h3>Department Address</h3>
                                <table>
                                  <tbody>
                                    <tr>
                                      <td><i class="lni lni-map-marker"></i></td>
                                      <td>{{$dept[0] -> location}}</td>
                                    </tr>
                                    <tr>
                                      <td><i class="lni lni-phone"></i></td>
                                      <td>Call Us Now!<br/>
                                          <a href="tel:{{$dept[0] -> telp_department}}">{{$dept[0] -> telp_department}}</a>
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
                                <h1>{{$dept[0] -> name}}</h1>
                                <img src="/images/departments/{{$dept[0] -> image}}" alt="{{$dept[0] -> name}}">
                            </div>
                            <div class="col-12">
                              <table>
                                <tbody>
                                  <tr>
                                    <td>Department Icon</td>
                                    <td><i class="lni {{$dept[0] -> icon}}"></i></td>
                                  </tr>
                                  <tr>
                                    <td>Department Rating</td>
                                    <td><span><ins>{{$dept['rating']['rating']}}</ins>/4.0</span></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="row wow fadeInDown">
                              <div class="col-12">
                                <h2>Description</h2>
                                {!! $dept[0] -> description !!}
                              </div>
                            </div>
                        </section>
                        <section class="services section pt-5">
                          <div class="container">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="services-content">
                                          <div class="row pl-4 pr-4 justify-content-center">
                                              <h2 class="wow fadeInDown pb-4">Department Services</h2>
                                              @foreach($dept['services'] as $serv)
                                                <div class="col-md-6 col-12 p-0">
                                                    <div class="single-list custom-border-right wow fadeInDown m-0"
                                                        data-wow-delay=".2s">
                                                        <img class="shape1" src="/images/service/shape1.svg" alt="#">
                                                        <img class="shape2" src="/images/service/shape2.svg" alt="#">
                                                        <i class="lni {{$serv -> icon}}"></i>
                                                        <h4><a href="/pelayanan/{{$serv -> name}}?idserv={{$serv -> id}}">{{$serv -> name}}</a></h4>
                                                        <p>{{$serv -> description_title}}</p>
                                                    </div>
                                                </div>
                                              @endforeach
                                          </div>
                                      </div>
                                  </div>
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
                      <button id="department-detail-images-prev-btn">
                        <svg
                        class="reverse"
                        xmlns="http://www.w3.org/2000/svg"
                        height="4rem"
                        viewBox="0 50 400 250"
                        width="4rem"
                        style="--rotate:-90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
                      </button>
                      <div class="item-image-container-root">
                        <div id="item-image-department-detail-container" class="item-image-container">
                          @for($i=0;$i < count($dept['image']);$i++)
                            <div class="item-image">
                              <a href="/images/departments/{{$dept['image'][$i] -> media}}" class="glightbox3">
                                <img src="/images/departments/{{$dept['image'][$i] -> media}}" alt="{{$dep_name}}">
                              </a>
                            </div>
                          @endfor
                        </div>
                      </div>
                      <button id="department-detail-images-next-btn"><svg
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
@endforeach

@include('User.Component.Utils.footerHome')
<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/glightbox.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/department-details.js')}}"></script>

@include('User.Component.Utils.footer')
