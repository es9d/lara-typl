<div class="card user-profile-card">
    <div class="profile-header p-2">
        <img class="mb-5 img-company-logo" @if(Auth::User()->getAvatarUrl()) src="{{ Auth::User()->getAvatarUrl() }}" @else src="/images/empty.png" @endif " alt="">
        <h4>{{Auth::User()->getDisplayName()}}</h4>
        <div>Restaurant</div>
    </div>
    <div class="profile-main">
        <div class="col-pl-6 job-count">
            <a href="{{ route('job.vendor.index',['status'=>'publish'])}}" class="btn">
                <h5>{{ $job_count['publish'] }}</h5>
                <p class="job-opened">Jobs</p>
            </a>
        </div>
        <div class="col-pl-6 job-count">
            <a href="{{ route('job.vendor.index',['status'=>'draft'])}}" class="btn">
                <h5>{{ $job_count['closed'] }}</h5>
                <p class="job-closed">Paused&nbspJobs</p>
            </a>
        </div>
    </div>
    <div class="profile-contact">
        <div>
            <button class="btn btn-contact-icon p-0"><i class="fas fa-phone-alt"></i></button>
            <span class="contact-text">{{ Auth::User()->mobile }}</span>
        </div>
        <div>
            <button class="btn btn-contact-icon"><i class="fa fa-envelope email-icon"></i></button>
            <span class="contact-text">{{ Auth::User()->contact_email }}</span>
            
        </div>
    </div>
</div>
