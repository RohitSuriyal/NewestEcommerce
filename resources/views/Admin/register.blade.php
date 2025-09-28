<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        /* From Uiverse.io by Yaya12085 */
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f7fa;
            font-family: Arial, sans-serif;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.15);
        }

        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before,
        .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message,
        .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input+span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown+span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus+span,
        .form label .input:valid+span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid+span {
            color: green;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <form class="form" action="{{route('admin.register')}}" method="post">
        @csrf
        <p class="title">Register </p>
        <p class="message">Signup now and get full access to our app. </p>

        {{-- Success Message --}}
        @if(session('status'))
            <div style="color: green; font-size:14px; margin-bottom:10px;">
                {{ session('status') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
                <div style="
                background-color: #fee2e2;
                color: #b91c1c;
                border: 1px solid #fca5a5;
                padding: 12px 16px;
                border-radius: 8px;
                font-size: 14px;
                margin-bottom: 15px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            ">
                    <strong>❌ Please fix the following errors:</strong>
                    <ul style="margin: 8px 0 0 18px; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

        {{-- Email --}}
        <label>
            <input name="email" type="email" class="input" value="{{ old('email') }}">
            <span>Email</span>
        </label>
        @error('email')
            <div style="color: red; font-size:12px;">{{ $message }}</div>
        @enderror

        {{-- Password --}}
        <label>
            <input name="password" type="password" class="input">
            <span>Password</span>
        </label>
        @error('password')
            <div style="color: red; font-size:12px;">{{ $message }}</div>
        @enderror

        {{-- Confirm Password --}}
        <label>
            <input name="password_confirmation" type="password" class="input">
            <span>Confirm password</span>
        </label>

        <button class="submit">Submit</button>
        <p class="signin">Already have an account ? <a href="{{route('adminloginview')}}">Signin</a> </p>
    </form>

</body>

</html>