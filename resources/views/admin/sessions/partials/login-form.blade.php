<form action="{{route('login.post')}}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="email" class="form-control autocomplete" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
    </div>

    <div class="other-actions row">
        <div class="col-6">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('forgot-password.index')}}" class="forgot-link">Forgot Password?</a>
        </div>
    </div>
    <button class="btn btn-theme btn-full">Login</button>
    <div class="form-group other-options">
        <div class="social-caption pull-left">
            <h6>
                Or Login With
            </h6>
        </div>
        <div class="social-icons pull-right">
            <a href="/auth/facebook" class="btn btn-default text-primary btn-icon"><i class="icon-fa icon-fa-facebook"></i></a>
            <a href="/auth/google" class="btn btn-default text-danger btn-icon"><i class="icon-fa icon-fa-google"></i></a>
<<<<<<< HEAD
            {{-- <a href="/auth/github" class="btn btn-default btn-icon text-default"><i class="icon-fa icon-fa-github"></i></a> --}}
=======
            <a href="/auth/github" class="btn btn-default btn-icon text-default"><i class="icon-fa icon-fa-github"></i></a>
>>>>>>> 9364050604be82bb21bf77314501118a9268d954
        </div>
    </div>
</form>