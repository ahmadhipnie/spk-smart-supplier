@extends('layouts.auth')

@section('content')
<div style="
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
">
    <div style="width: 100%; max-width: 640px;">
        <!-- Title (restored) -->
        <div style="margin-bottom: 25px; text-align: center;">
            <a href="#" style="text-decoration: none; color: inherit;">
                <h1 style="
                    color: #fff;
                    font-size: 32px;
                    font-weight: 700;
                    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
                    margin: 0;
                    letter-spacing: 1px;
                ">
                    <i class="fas fa-balance-scale" style="margin-right: 8px;"></i> <b>SPK</b> Supplier
                </h1>
            </a>
        </div>

        <!-- Card Login -->
        <div style="
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            position: relative;
        ">
            <!-- Header Biru di Card -->
            <div style="
                background: #f8f9fa;
                padding: 25px 30px;
                border-bottom: 1px solid #eee;
                text-align: center;
            ">
                <h5 style="
                    margin: 0;
                    color: #333;
                    font-size: 18px;
                    font-weight: 600;
                ">
                    Silakan Login
                </h5>
            </div>

            <!-- Content: logo (left) + form (right) -->
            <div style="padding: 30px; display:flex; gap:20px; align-items:center; flex-wrap:wrap;">
                <!-- Logo (di dalam card, kiri) -->
                <div style="flex:0 0 180px; display:flex; align-items:center; justify-content:center;">
                    <img src="{{ asset('img/logo2.png') }}" alt="SPK SMART" style="max-width:180px; width:100%; height:auto; object-fit:contain; display:block;">
                </div>

                <!-- Form + Alerts -->
                <div style="flex:1; min-width:0;">
                    <!-- Alert Success -->
                    @if(session('success'))
                        <div style="
                            background-color: #d4edda;
                            color: #155724;
                            padding: 12px 15px;
                            border-radius: 5px;
                            margin-bottom: 20px;
                            font-size: 14px;
                            border-left: 4px solid #28a745;
                        ">
                            <i class="fas fa-check-circle" style="margin-right: 5px;"></i> {{ session('success') }}
                        </div>
                    @endif

                    <!-- Alert Error -->
                    @if($errors->any())
                        <div style="
                            background-color: #f8d7da;
                            color: #721c24;
                            padding: 12px 15px;
                            border-radius: 5px;
                            margin-bottom: 20px;
                            font-size: 14px;
                            border-left: 4px solid #dc3545;
                        ">
                            <i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i> 
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        
                        <!-- Email Input -->
                        <div style="margin-bottom: 20px; position: relative;">
                            <label style="
                                display: block;
                                margin-bottom: 8px;
                                color: #555;
                                font-weight: 600;
                                font-size: 14px;
                            ">Email Address</label>
                            <div style="position: relative;">
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email..."
                                    style="
                                        width: 100%;
                                        padding: 12px 15px 12px 45px;
                                        border: 1px solid #ddd;
                                        border-radius: 6px;
                                        font-size: 14px;
                                        color: #333;
                                        background-color: #fff;
                                        box-sizing: border-box; /* Penting agar padding tidak melebarkan input */
                                        transition: border-color 0.3s;
                                    "
                                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                                    onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';"
                                >
                                <i class="fas fa-envelope" style="
                                    position: absolute;
                                    left: 15px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    color: #aaa;
                                "></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div style="margin-bottom: 20px; position: relative;">
                            <label style="
                                display: block;
                                margin-bottom: 8px;
                                color: #555;
                                font-weight: 600;
                                font-size: 14px;
                            ">Password</label>
                            <div style="position: relative;">
                                <input type="password" name="password" required placeholder="Masukkan password..."
                                    style="
                                        width: 100%;
                                        padding: 12px 15px 12px 45px;
                                        border: 1px solid #ddd;
                                        border-radius: 6px;
                                        font-size: 14px;
                                        color: #333;
                                        background-color: #fff;
                                        box-sizing: border-box;
                                        transition: border-color 0.3s;
                                    "
                                    onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                                    onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none';"
                                >
                                <i class="fas fa-lock" style="
                                    position: absolute;
                                    left: 15px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    color: #aaa;
                                "></i>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div style="margin-bottom: 25px; display: flex; align-items: center;">
                            <input type="checkbox" name="remember" id="remember" style="
                                width: 16px;
                                height: 16px;
                                margin-right: 8px;
                                cursor: pointer;
                            ">
                            <label for="remember" style="
                                font-size: 14px;
                                color: #666;
                                cursor: pointer;
                                user-select: none;
                            ">Ingat Saya</label>
                        </div>

                        <!-- Button Login -->
                        <button type="submit" style="
                            width: 100%;
                            padding: 12px;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            color: #fff;
                            border: none;
                            border-radius: 6px;
                            font-size: 16px;
                            font-weight: 600;
                            cursor: pointer;
                            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
                            transition: transform 0.2s, box-shadow 0.2s;
                        "
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(102, 126, 234, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(102, 126, 234, 0.3)';"
                        >
                            <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i> LOGIN
                        </button>
                    </form>
                </div>
            </div>

            {{-- <!-- Footer Card -->
            <div style="
                background: #f8f9fa;
                padding: 15px 30px;
                border-top: 1px solid #eee;
                font-size: 13px;
                color: #666;
            ">
                <p style="margin: 0 0 5px 0; font-weight: 600; text-align: center;">Akun Default:</p>
                <div style="display: flex; justify-content: space-between; font-size: 12px;">
                    <div><strong style="color: #dc3545;">Admin:</strong> admin@admin.com</div>
                    <div><strong style="color: #007bff;">Pass:</strong> password</div>
                </div>
            </div> --}}
        </div>

        <!-- Copyright -->
        <p style="
            text-align: center;
            margin-top: 25px;
            color: rgba(255,255,255,0.8);
            font-size: 13px;
        ">
            &copy; 2025 SPK Supplier - Metode SMART
        </p>
    </div>
</div>
@endsection
