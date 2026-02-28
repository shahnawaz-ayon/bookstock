@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; margin-top: -24px;">
    <div style="text-align: center; color: white; padding: 20px; max-width: 800px;">
        
        {{-- Icon/Logo Placeholder --}}
        <div style="font-size: 60px; margin-bottom: 20px;">📚</div>
        
        <h1 style="font-size: 3.5rem; font-weight: 800; margin-bottom: 15px; letter-spacing: -1px;">
            BookStock Manager
        </h1>
        
        <p style="font-size: 1.25rem; opacity: 0.9; margin-bottom: 40px; line-height: 1.6;">
            The ultimate digital sanctuary for your personal library. 
            Track your collection, manage authors, and organize categories with ease.
        </p>

        <div style="display: flex; gap: 20px; justify-content: center;">
            <a href="{{ route('books.index') }}" class="btn-welcome-primary">
                Enter Library
            </a>
            <a href="{{ route('books.create') }}" class="btn-welcome-secondary">
                + Add First Book
            </a>
        </div>

        {{-- Statistics Preview --}}
        <div style="margin-top: 60px; display: flex; justify-content: center; gap: 50px; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 40px;">
            <div>
                <div style="font-size: 24px; font-weight: bold;">Quick</div>
                <div style="font-size: 14px; opacity: 0.8;">Uploads</div>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: bold;">Secure</div>
                <div style="font-size: 14px; opacity: 0.8;">Storage</div>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: bold;">Easy</div>
                <div style="font-size: 14px; opacity: 0.8;">Management</div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-welcome-primary {
        background-color: white;
        color: #667eea;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 18px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .btn-welcome-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        color: #764ba2;
    }

    .btn-welcome-secondary {
        background-color: rgba(255,255,255,0.1);
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 18px;
        border: 2px solid white;
        transition: background 0.2s;
    }
    .btn-welcome-secondary:hover {
        background-color: white;
        color: #667eea;
    }
</style>
@endsection