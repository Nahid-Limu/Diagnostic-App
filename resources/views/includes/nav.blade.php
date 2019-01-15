<div id="nav" class="row navbar">
    <div class="col-md-3">
        <img src="{{ asset('img').'/'."final-logo.png "}}" alt="opps"  class="img img-responsive img-circle pull-left" style="width: 100px; height: 100px;"/>
    </div>
    <div class="col-md-6">
        <marquee behavior="alternate"><h2 class="" style="font-weight: bold; margin-bottom: 50px; font-family: cursive; font-size: 20px; color: red;" >DG App</h2></marquee>
    </div>
    <div class="col-md-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</div>