@php Theme::set('pageName', __('Login')) @endphp

 <div class="login_register_wrap section">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-xl-6 col-md-10">
                 <div class="login_wrap">
                     <div class="padding_eight_all bg-white">
                         <div class="heading_s1">
                             <h3>{{ __('Login') }}</h3>
                         </div>
                         @if (session('error'))
                             <div class="alert alert-danger">
                                 <span>{{ session('error') }}</span>
                             </div>
                         @endif
                         @if (isset($errors) && $errors->any())
                             <div class="alert alert-danger">
                                 @foreach ($errors->all() as $error)
                                     <span>{{ $error }}</span><br>
                                 @endforeach
                             </div>
                         @endif
                         <form method="POST" action="{{ route('public.admin-login') }}">
                             @csrf
                             <div class="form-group">
                                 <input class="form-control" name="email" id="txt-email" type="email" value="" autocomplete="off" placeholder="{{ __('Your Email') }}">
                             </div>
                             <div class="form-group">
                                 <input class="form-control" type="password" name="password" id="txt-password" value="" autocomplete="new-password" placeholder="{{ __('Password') }}">
                             </div>
                             <div class="login_footer form-group">
                                 <div class="chek-form">
                                     <div class="custome-checkbox">
                                         <input class="form-check-input" type="checkbox" name="remember" id="remember-me" value="1">
                                         <label class="form-check-label" for="remember-me"><span>{{ __('Remember me') }}</span></label>
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-fill-out btn-block">{{ __('Log In') }}</button>
                             </div>
                        </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END LOGIN SECTION -->
