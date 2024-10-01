@extends('customer.layouts.master')
@section('title', 'Welcome')
@section('content')
    <div class="loader-screen" id="splashscreen">
        <div class="main-screen">
            <!-- <div class="circle-1">                
                <img src="{{asset('customer/assets/images/food1.png')}}" alt="food-image">
            </div> -->
            <div class="circle-2"></div>
            <div class="circle-3"></div>
            <div class="circle-4"></div>
            <div class="circle-5"></div>
            <div class="circle-6"></div>
            <!-- <div class="circle-7">
                <img src="{{asset('customer/assets/images/food2.png')}}" alt="food-image">
            </div> -->
            <div class="brand-logo">
                <div class="logo">
                    <img src="{{asset('customer/assets/images/logo-item/spoon1.svg')}}" alt="spoon-1" class="wow bounceInDown">
                    <img class="wow bounceInUp" src="{{asset('customer/assets/images/logo-item/spoon2.svg')}}" alt="spoon-1">
                </div>
                <h1 class="brand-title text-white mt-3">Foodia</h1>
            </div>
        </div>                                        
    </div>                                        
    <!-- splash-->
    
<div class="page-wraper">
    <!-- Page Content -->
    <div class="page-content page page-onboading">
        <!-- Onboading Start -->
        <div class="started-swiper-box">
            <div class="swiper-container get-started">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-info">
                            <div class="dz-media">
                                <img src="{{asset('customer/assets/images/shop.png')}}" alt="image"/>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-info">
                            <div class="dz-media">
                                <img src="{{asset('customer/assets/images/truck.png')}}" alt="image"/>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="swiper-slide">
                        <div class="slide-info">
                            <div class="dz-media">
                                <img src="{{asset('customer/assets/images/stock.svg')}}" alt="image"/>
                            </div>
                        </div>
                    </div> -->
                    <div class="swiper-slide">
                        <div class="slide-info">
                            <div class="dz-media">
                                <img src="{{asset('customer/assets/images/delivery.png')}}" alt="image"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-btn">
                <div class="swiper-pagination style-1 flex-1"></div>
            </div>
            <div class="slide-content">
                <h1 class="brand-title">Foodia</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
            </div>
        </div>
        <!-- Onboading End-->    
    </div>
    <!-- Page Content End-->
    
    <!-- Footer -->
    <footer class="footer border-0">
        <div class="container">
            <a href="welcome.html" class="btn btn-primary btn-rounded d-block">LET'S ROCK</a>
        </div>
    </footer>
    <!-- Footer End-->
</div>   
@endsection