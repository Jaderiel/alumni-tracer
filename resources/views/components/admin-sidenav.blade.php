<div class="logo">
            <h2>LVCC Alumni <br> Tracking System</h2>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-house"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><i class="fa-solid fa-users"></i><a href="alumni-list.html">Alumni List</a></li>
            <li><i class="fa-solid fa-calendar-days"></i><a href="events.html">Events</a></li>
            <li><i class="fa-solid fa-briefcase"></i><a href="jobs.html">Jobs</a></li>
            <li><i class="fa-solid fa-image"></i><a href="gallery.html">Gallery</a></li>
            <li><i class="fa-solid fa-chart-line"></i><a href="analytics.html">Analytics</a></li>
            <li><i class="fa-solid fa-check-circle"></i><a href="{{ route('approvals') }}">Approvals</a></li><br><br><br><br>
            <li><i class="fa-solid fa-user-gear"></i><a href="profile.html">Profile</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
</a></li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

        </div>