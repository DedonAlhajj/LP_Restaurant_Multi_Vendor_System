@extends('customer.layouts.masterAuth')
@section('title', 'Regsetr')
@section('content')
<div class="page-wraper">
    <!-- Preloader -->
	<div id="preloader">
		<div class="spinner"></div>
	</div>
    <!-- Preloader end-->
    <!-- Page Content -->
    <div class="page-content">
        
        <!-- Banner -->
        <div class="banner-wrapper">
            <div class="circle-1"></div>
            <div class="container inner-wrapper">
                <h1 class="dz-title">Foodia</h1>
                <p class="mb-0">Restaurant App</p>
            </div>
        </div>
        <!-- Banner End -->
        
        <div class="account-box">
            <div class="container">
                <div class="account-area">
                    <h3 class="title">Create your account</h3>
                    <p>Lorem ipsum dolor sit amet</p>
					<form class="input-style">
						<div class="input-group input-mini mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" placeholder="Name">
						</div>
						<div class="mb-3 input-group input-mini">
							<span class="input-group-text"><i class="fa fa-at"></i></span>
							<input type="email" class="form-control" placeholder="Email">
						</div>
						<div class="mb-3 input-group input-mini">
							<span class="input-group-text"><i class="fa fa-lock"></i></span>
							<input type="password" class="form-control dz-password" placeholder="Password">
							<span class="input-group-text show-pass"> 
								<i class="fa fa-eye-slash"></i>
								<i class="fa fa-eye"></i>
							</span>
						</div>
						<div class="input-group">
							<a href="index.html" class="btn mt-2 btn-primary w-100 btn-rounded">SIGN UP</a>
						</div>
						<div class="d-flex justify-content-between align-items-center">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
								<label class="form-check-label" for="flexCheckChecked">
									By tapping “Sign Up” you accept our <a href="javascript:void(0);" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom">terms</a> and <a href="javascript:void(0);" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom">Condition</a>
								</label>
							</div>
						</div>
					</form>  
                    <div class="text-center mb-auto p-tb20">
                        <a href="login.html" class="saprate">Already have account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content End -->
    
    <!-- Footer -->
    <footer class="footer fixed">
        <div class="container">
            <a href="login.html" class="btn btn-transparent btn-rounded d-block">SIGN IN</a>
        </div>
    </footer>
    <!-- Footer End -->
    
    <!-- Theme Color Settings -->
	<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
        <div class="offcanvas-body small">
            <ul class="theme-color-settings">
                <li>
                    <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary" />
					<label for="primary_color_8"></label>
                    <span>Default</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green" />
					<label for="primary_color_2"></label>
                    <span>Green</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue" />
					<label for="primary_color_3"></label>
                    <span>Blue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink" />
					<label for="primary_color_4"></label>
                    <span>Pink</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow" />
					<label for="primary_color_5"></label>
                    <span>Yellow</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange" />
					<label for="primary_color_6"></label>
                    <span>Orange</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple" />
					<label for="primary_color_7"></label>
                    <span>Purple</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red" />
					<label for="primary_color_1"></label>
                    <span>Red</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue" />
					<label for="primary_color_9"></label>
                    <span>Lightblue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal" />
					<label for="primary_color_10"></label>
                    <span>Teal</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime" />
					<label for="primary_color_11"></label>
                    <span>Lime</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange" />
					<label for="primary_color_12"></label>
                    <span>Deeporange</span>
                </li>
            </ul>
        </div>
    </div>
	<!-- Theme Color Settings End -->
	<!-- CART -->
	<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom2">
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
			<i class="fa-solid fa-xmark"></i>
		</button>
        <div class="offcanvas-body">
			<h4 class="title border-bottom pb-2 mb-2">Terms & Condition</h4>
			<p class="mb-0">Lorem ipsum dolor sit amet const Lorem ipsum dolor sit amet const Lorem ipsum dolor sit amet const Lorem ipsum dolor sit amet const.</p>
        </div>
    </div>
	<!-- CART -->
</div>
@endsection