<x-cover_page_layout>
    <style>
        form {
            padding: 30px;
            border-radius: 10px;
            width: 400px;
        }

        h3 {
            text-align: center
        }

        img {
            width: 440px;
            height: 400px;
            border-radius: 20px;
        }
    </style>
    <div class="d-flex">
        <div class="d-flex justify-content-center align-items-center" style="width: 100%">
            <div class="d-flex justify-content-center align-items-center">
                <div>
                    <h3 style="font-family: 'Times New Roman', Times, serif">ES Courses</h3>
                    <img src="storage/img/cover1.jpg" alt="img">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center m-5" style="width: 100%;">
            <div id="registration_form" style="display: none;height:500px">
                <div class="d-flex justify-content-center align-items-center">
                    <div style="margin-top:20px">
                        @if ($errors->any())
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li
                                        style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 5px;">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <h3>Regisrtation</h3>
                        <form action="/user_registration" method="post" class="shadow-lg">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    value="{{ old('password') }}" required>
                            </div>
                            @error('password')
                                <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('cpassword') }}" required>
                            </div>
                            @error('cpassword')
                                <p style="color: rgb(231, 17, 17)">{{ $message }}</p>
                            @enderror
                            <div class="d-flex justify-content-center align-items-center my-4">
                                <button class="form-control bg-primary">Register</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary" onclick="login_form()">Existing user</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="login_form" style="display: block;height:500px;">
                <div style="margin-top:100px">
                    <div>
                        @if ($errors->any())
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li
                                        style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 5px;">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if ($errors->any())
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li
                                        style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 5px;">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <h3>Login</h3>
                        <form action="/login_authentication" method="post" class="shadow-lg">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="user_email">Email:</label>
                                <input type="text" class="form-control" name="user_email" id="user_email"
                                    value="{{ old('user_email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_password">password:</label>
                                <input type="password" class="form-control" name="user_password" id="user_password"
                                    value="{{ old('user_password') }}" required>
                            </div>
                            <div class="d-flex justify-content-center align-items-center m-4">
                                <button type="submit" class="form-control bg-primary">Login</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary" onclick="registration_form()">New user</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function login_form() {
                document.getElementById('login_form').style.display = 'block';
                document.getElementById('registration_form').style.display = 'none';
            }

            function registration_form() {
                document.getElementById('login_form').style.display = 'none';
                document.getElementById('registration_form').style.display = 'block';
            }
        </script>
</x-cover_page_layout>
