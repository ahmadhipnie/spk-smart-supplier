@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Aktivitas Akun</h3>
                    <div class="card-tools">
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    {{-- Container timeline --}}
                    <div style="position: relative; margin: 0 0 30px 0; padding: 0; list-style: none;">
                        {{-- Garis vertikal --}}
                        <div style="
                            content: '';
                            position: absolute;
                            top: 0;
                            bottom: 0;
                            width: 4px;
                            background: #ddd;
                            left: 31px;
                            ">
                        </div>

                        {{-- Label: Akun terdaftar --}}
                        <div style="margin: 0 0 15px 0;">
                            <span style="
                                font-weight: 600;
                                padding: 5px 10px;
                                background-color: #28a745;
                                color: #fff;
                                border-radius: 4px;
                                position: relative;
                                left: 60px;
                                ">
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <div style="position: relative; margin-right: 10px; margin-bottom: 15px;">
                            {{-- Icon bulat --}}
                            <i class="fas fa-user"
                               style="
                                   width: 30px;
                                   height: 30px;
                                   font-size: 15px;
                                   line-height: 30px;
                                   position: absolute;
                                   color: #fff;
                                   background: #007bff;
                                   border-radius: 50%;
                                   text-align: center;
                                   left: 18px;
                                   top: 0;
                               ">
                            </i>

                            {{-- Box item --}}
                            <div style="
                                margin-top: 0;
                                background: #fff;
                                color: #444;
                                margin-left: 60px;
                                margin-right: 15px;
                                padding: 10px;
                                border: 1px solid #ddd;
                                border-radius: 4px;
                                ">
                                <span style="float: right; color: #999; font-size: 12px;">
                                    <i class="fas fa-clock"></i> {{ $user->created_at->format('H:i') }}
                                </span>
                                <h3 style="margin-top: 0; font-size: 16px; font-weight: 600;">Akun Terdaftar</h3>
                                <div>
                                    Akun Anda berhasil didaftarkan di sistem Pemilihan Supplier dengan role
                                    <strong>{{ ucfirst($user->role) }}</strong>.
                                </div>
                            </div>
                        </div>

                        {{-- Email terverifikasi --}}
                        @if($user->email_verified_at)
                        <div style="margin: 15px 0;">
                            <span style="
                                font-weight: 600;
                                padding: 5px 10px;
                                background-color: #28a745;
                                color: #fff;
                                border-radius: 4px;
                                position: relative;
                                left: 60px;
                                ">
                                {{ $user->email_verified_at->format('d M Y') }}
                            </span>
                        </div>

                        <div style="position: relative; margin-right: 10px; margin-bottom: 15px;">
                            <i class="fas fa-check-circle"
                               style="
                                   width: 30px;
                                   height: 30px;
                                   font-size: 15px;
                                   line-height: 30px;
                                   position: absolute;
                                   color: #fff;
                                   background: #28a745;
                                   border-radius: 50%;
                                   text-align: center;
                                   left: 18px;
                                   top: 0;
                               ">
                            </i>

                            <div style="
                                margin-top: 0;
                                background: #fff;
                                color: #444;
                                margin-left: 60px;
                                margin-right: 15px;
                                padding: 10px;
                                border: 1px solid #ddd;
                                border-radius: 4px;
                                ">
                                <span style="float: right; color: #999; font-size: 12px;">
                                    <i class="fas fa-clock"></i> {{ $user->email_verified_at->format('H:i') }}
                                </span>
                                <h3 style="margin-top: 0; font-size: 16px; font-weight: 600;">Email Terverifikasi</h3>
                                <div>
                                    Email <strong>{{ $user->email }}</strong> berhasil diverifikasi.
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Update terakhir --}}
                        <div style="margin: 15px 0;">
                            <span style="
                                font-weight: 600;
                                padding: 5px 10px;
                                background-color: #17a2b8;
                                color: #fff;
                                border-radius: 4px;
                                position: relative;
                                left: 60px;
                                ">
                                {{ $user->updated_at->format('d M Y') }}
                            </span>
                        </div>

                        <div style="position: relative; margin-right: 10px; margin-bottom: 15px;">
                            <i class="fas fa-edit"
                               style="
                                   width: 30px;
                                   height: 30px;
                                   font-size: 15px;
                                   line-height: 30px;
                                   position: absolute;
                                   color: #fff;
                                   background: #17a2b8;
                                   border-radius: 50%;
                                   text-align: center;
                                   left: 18px;
                                   top: 0;
                               ">
                            </i>

                            <div style="
                                margin-top: 0;
                                background: #fff;
                                color: #444;
                                margin-left: 60px;
                                margin-right: 15px;
                                padding: 10px;
                                border: 1px solid #ddd;
                                border-radius: 4px;
                                ">
                                <span style="float: right; color: #999; font-size: 12px;">
                                    <i class="fas fa-clock"></i> {{ $user->updated_at->format('H:i') }}
                                </span>
                                <h3 style="margin-top: 0; font-size: 16px; font-weight: 600;">Update Terakhir</h3>
                                <div>
                                    Profil atau informasi akun terakhir diupdate.
                                </div>
                            </div>
                        </div>

                        {{-- Penutup timeline --}}
                        <div style="position: relative; margin-right: 10px; margin-bottom: 0;">
                            <i class="fas fa-clock"
                               style="
                                   width: 30px;
                                   height: 30px;
                                   font-size: 15px;
                                   line-height: 30px;
                                   position: absolute;
                                   color: #666;
                                   background: #d2d6de;
                                   border-radius: 50%;
                                   text-align: center;
                                   left: 18px;
                                   top: 0;
                               ">
                            </i>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Informasi:</strong> Timeline ini menampilkan aktivitas penting pada akun Anda. 
                        Data login dan aktivitas detail dapat dilihat di log sistem.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
