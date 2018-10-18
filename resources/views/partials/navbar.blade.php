<div class="ui huge teal inverted menu">
    <a class="active item" href="/dashboard">
        Home
    </a>
    <a class="item">
        Messages
    </a>
    <a class="item">
        Friends
    </a>
    <div class="right menu">
    </div>
    <div class="ui right dropdown icon item">
        <i class="user icon white"></i>
        <div class="menu" style="font-family:'nunito';">
            <div class="header">
                User Profile
            </div>
            <div class="divider"></div>
            <a class="item" href="{{ route('profile') }}"><i class="edit green icon"></i> Edit Profile</a>
            <a class="item" href="{{ route('logout') }}"><i class="sign-out red icon"></i> Logout</a>
        </div>
    </div>

</div>
