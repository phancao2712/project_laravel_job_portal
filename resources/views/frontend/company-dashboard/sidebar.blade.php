<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="box-nav-tabs nav-tavs-profile mb-5">
        <ul class="nav" role="tablist">
            <li><a class="btn btn-border mb-20 active" href="{{ route('company.dashboard') }}">Dashboard</a></li>
            <li><a class="btn btn-border mb-20" href="{{ route('company.jobs.index') }}">Jobs</a></li>
            <li><a class="btn btn-border mb-20" href="{{ route('company.orders') }}">Orders</a></li>
            <li><a class="btn btn-border mb-20" href="{{ route('company.profile') }}">My Profile</a></li>
            <form method="POST" action="{{ route('logout') }}" style="width:100%">
                @csrf
                <li><a class="btn btn-border mb-20" onclick="event.preventDefault(); this.closest('form').submit();"
                        href="{{ route('logout') }}">Logout</a></li>
            </form>
        </ul>
    </div>
</div>
