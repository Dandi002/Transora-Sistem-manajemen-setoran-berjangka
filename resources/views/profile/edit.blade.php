@extends('layouts.app')

@push('styles')
<style>
    :root {
        --ep-text: #111827;
        --ep-title: #0f172a;
        --ep-subtitle: #64748b;
        --ep-card-bg: #ffffff;
        --ep-card-border: #e2e8f0;
        --ep-card-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        --ep-muted: #64748b;
        --ep-label: #334155;
        --ep-input-bg: #ffffff;
        --ep-input-border: #cbd5e1;
        --ep-input-text: #0f172a;
        --ep-input-placeholder: #94a3b8;
        --ep-split: #e2e8f0;
        --ep-avatar-border: #cbd5e1;
        --ep-focus: rgba(16, 185, 129, 0.18);
        --ep-danger-text: #dc2626;
        --ep-danger-border: #fecaca;
        --ep-danger-bg: #fff1f2;
    }

    .theme-dark {
        --ep-text: #e5e7eb;
        --ep-title: #f9fafb;
        --ep-subtitle: #9ca3af;
        --ep-card-bg: #232323;
        --ep-card-border: #454545;
        --ep-card-shadow: inset 0 1px 0 rgba(255,255,255,.04);
        --ep-muted: #9ca3af;
        --ep-label: #d1d5db;
        --ep-input-bg: #272727;
        --ep-input-border: #525252;
        --ep-input-text: #f3f4f6;
        --ep-input-placeholder: #94a3b8;
        --ep-split: #4b5563;
        --ep-avatar-border: #6b7280;
        --ep-focus: rgba(52, 211, 153, .15);
        --ep-danger-text: #fca5a5;
        --ep-danger-border: #7f1d1d;
        --ep-danger-bg: #231919;
    }

    .ep-wrap {
        max-width: 980px;
        margin: 0 auto;
        padding: 24px 24px 36px;
        color: var(--ep-text);
    }

    .ep-title {
        font-size: 28px;
        line-height: 1.15;
        font-weight: 800;
        color: var(--ep-title);
        margin-bottom: 4px;
    }

    .ep-subtitle {
        font-size: 13px;
        color: var(--ep-subtitle);
        margin-bottom: 18px;
    }

    .ep-card {
        background: var(--ep-card-bg);
        border: 1px solid var(--ep-card-border);
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 16px;
        box-shadow: var(--ep-card-shadow);
    }

    .ep-card-title {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--ep-muted);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .ep-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--ep-label);
        margin-bottom: 6px;
    }

    .ep-hint {
        display: block;
        font-size: 11px;
        color: var(--ep-muted);
        margin-top: 5px;
    }

    .ep-input {
        width: 100%;
        height: 42px;
        border-radius: 8px;
        border: 1px solid var(--ep-input-border);
        background: var(--ep-input-bg);
        color: var(--ep-input-text);
        padding: 0 12px;
        font-size: 14px;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .ep-input::placeholder {
        color: var(--ep-input-placeholder);
    }

    .ep-input:focus {
        border-color: #34d399;
        box-shadow: 0 0 0 3px var(--ep-focus);
    }

    .ep-textarea {
        min-height: 96px;
        padding: 10px 12px;
        resize: vertical;
    }

    .ep-field {
        margin-bottom: 12px;
    }

    .ep-split {
        border-top: 1px solid var(--ep-split);
        margin: 14px 0;
    }

    .ep-photo-row {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .ep-avatar {
        width: 74px;
        height: 74px;
        border-radius: 999px;
        overflow: hidden;
        border: 2px solid var(--ep-avatar-border);
        flex-shrink: 0;
    }

    .ep-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ep-user-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--ep-title);
    }

    .ep-user-meta {
        font-size: 11px;
        color: var(--ep-muted);
    }

    .ep-photo-actions {
        margin-top: 8px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .ep-btn {
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 10px;
        cursor: pointer;
        border: 1px solid transparent;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .ep-btn-primary {
        background: #16a34a;
        border-color: #16a34a;
        color: #ffffff;
    }

    .ep-btn-primary:hover {
        background: #15803d;
        border-color: #15803d;
    }

    .ep-btn-ghost {
        background: transparent;
        color: #fca5a5;
        border-color: #ef4444;
    }

    .ep-btn-ghost:hover {
        background: rgba(239, 68, 68, .15);
    }

    .ep-btn-save {
        background: #16a34a;
        border-color: #16a34a;
        color: #fff;
        min-width: 122px;
    }

    .ep-btn-save:hover {
        background: #15803d;
    }

    .ep-row-end {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .ep-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .ep-badge {
        display: inline-flex;
        align-items: center;
        height: 20px;
        padding: 0 8px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    .ep-badge-ok {
        background: rgba(34,197,94,.17);
        color: #86efac;
        border: 1px solid rgba(34,197,94,.35);
    }

    .ep-badge-warn {
        background: rgba(245,158,11,.18);
        color: #fcd34d;
        border: 1px solid rgba(245,158,11,.35);
    }

    .ep-link {
        color: #2563eb;
        text-decoration: underline;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        padding: 0;
        margin-left: 8px;
    }

    .theme-dark .ep-link {
        color: #93c5fd;
    }

    .ep-error {
        margin-top: 5px;
        color: #fca5a5;
        font-size: 12px;
    }

    .ep-success {
        color: #86efac;
        font-size: 12px;
        font-weight: 700;
    }

    .ep-card-danger {
        border-color: var(--ep-danger-border);
        background: var(--ep-danger-bg);
    }

    .ep-card-title-danger {
        color: var(--ep-danger-text);
    }

    .ep-danger-desc {
        color: var(--ep-text);
        opacity: .9;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .ep-btn-danger-outline {
        border-color: #ef4444;
        color: #ef4444;
        background: transparent;
    }

    .ep-btn-danger-outline:hover {
        background: rgba(239, 68, 68, .08);
    }

    @media (max-width: 900px) {
        .ep-grid-2 {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .ep-wrap {
            padding: 18px 12px 28px;
        }

        .ep-title {
            font-size: 24px;
        }
    }
</style>
@endpush

@section('content')
<div class="ep-wrap">
    <h1 class="ep-title">Edit profil</h1>
    <p class="ep-subtitle">Perbarui foto, informasi akun, dan kata sandi Anda.</p>

    @include('profile.partials.update-profile-information-form')
    <div class="ep-grid-2">
        <div>
            @include('profile.partials.update-password-form')
        </div>
        <div>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
