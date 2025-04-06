<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        </script>
    @endif

    <div class="main">

        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>

                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                @if ($errors->has('name') && old('_form') == 'signup')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email') && old('_form') == 'signup')
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif

                <input type="password" name="password" placeholder="Password">
                @if ($errors->has('password') && old('_form') == 'signup')
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif

                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                @if ($errors->has('password_confirmation') && old('_form') == 'signup')
                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                @endif

                <input type="hidden" name="_form" value="signup"> <!-- Identify which form was submitted -->
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required="">
                @if ($errors->has('email') && old('_form') == 'login')
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif

                <input type="password" name="password" placeholder="Password" required="">
                @if ($errors->has('password') && old('_form') == 'login')
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif

                <input type="hidden" name="_form" value="login"> <!-- Identify which form was submitted -->
                <button type="submit">Login</button>
            </form>

        </div>
    </div>
</body>

</html>
