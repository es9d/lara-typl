<form class="form bravo-form-register" method="post">
    @csrf
    <div class="form-group">
        <label for="business_name">Company Name</label>
        <input type="text" class="form-control required" name="business_name" autocomplete="off" placeholder="{{__("Company Name")}}" required>
    </div>
    <div class="form-group mt-5">
        <label for="business_id">Company ID</label>
        <input type="text" class="form-control required" name="business_id" autocomplete="off" placeholder="{{__("Company Id")}}" required>
    </div>
    <div class="form-group mt-5">
        <label for="email">Email Address</label>
        <input type="email" class="form-control required" name="email" autocomplete="off" placeholder="{{__('Email address')}}" required>
    </div>
    <div class="form-group mt-5">
        <label for="password">Password</label>
        <input type="password" class="form-control required" name="password" autocomplete="off" placeholder="{{__('Password')}}" required>
    </div>
    <div class="form-group mt-5">
        <label for="repassword">Re-Type Password</label>
        <input type="repassword" class="form-control required" name="password" autocomplete="off" placeholder="{{__('Password')}}" required>
    </div>
    <div class="form-group mt-5">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5 required" required>
            {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and<span style='color:#ff8149;'> Privacy Policy</span></a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
            <span class="checkmark fcheckbox"></span>
        </label>
    </div>
    @if(setting_item("user_enable_register_recaptcha"))
        <div class="form-group mt-5">
            {{recaptcha_field($captcha_action ?? 'register')}}
        </div>
    @endif
    <div class="form-group mt-5">
        <button type="submit" class="btn btn-primary form-control form-submit sign">
            {{ __('CREATE ACCOUNT') }}
        </button>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
        <div class="advanced">
            <p class="text-center f14 c-grey">{{__("or continue with")}}</p>
            <div class="row">
                @if(setting_item('facebook_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('/social-login/facebook')}}" class="btn btn_login_fb_link"
                           data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            {{__('Facebook')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/google')}}" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            {{__('Google')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('twitter_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/twitter')}}" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            {{__('Twitter')}}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif
</form>