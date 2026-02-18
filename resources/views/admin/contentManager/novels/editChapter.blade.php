@extends('layouts.admin')

@section('title', $title)

@section('content')
<!-- ...styles and layout unchanged... -->

<div id="app">
<style>
    /* Override default Choices.js styles */
    :root {
      --primary: #2563eb;
      --primary-dark: #1e4ed8;
      --border: #d1d5db;
      --bg: #f8fafc;
      --muted: #6b7280;
      --danger: #ef4444;
    }

    .uploader {
      width: 100%;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.08);
      padding: 20px;
    }
    
    .hint { margin: 0 0 12px; font-size: 0.9rem; color: var(--muted); }

    .dropzone {
      border: 2px dashed var(--border);
      border-radius: 12px;
      background: #f9fafb;
      display: grid;
      place-items: center;
      gap: 8px;
      padding: 28px;
      text-align: center;
      cursor: pointer;
      transition: background .2s, border-color .2s, box-shadow .2s;
    }
    .dropzone:hover,
    .dropzone.drag { background: #f3f4f6; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.15); }
    .dropzone .icon { width: 36px; height: 36px; color: var(--muted); }
    
    .grid-1 {
      margin-top: 14px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 12px;
    }
    
    .thumb {
      position: relative;
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      background: #fff;
      height: 100px;
      display: grid;
      place-items: center;
    }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }
    .thumb.empty { color: var(--muted); background: #f3f4f6; font-size: 0.9rem; }
    
    .remove {
      position: absolute;
      top: 6px;
      right: 6px;
      border: none;
      background: rgba(17,24,39,.7);
      color: white;
      width: 24px; height: 24px;
      border-radius: 50%;
      cursor: pointer;
    }
    .remove:hover { background: rgba(17,24,39,.9); }
    
    .error { margin-top: 8px; color: var(--danger); font-size: .9rem; min-height: 1.2em; }
    .actions { margin-top: 14px; }
    
    .btn {
      background: var(--primary);
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
    }
    .btn:disabled { opacity: .5; cursor: not-allowed; }

   /* ---- CKEDITOR 5 NUCLEAR FIXES ---- */
    .ck-editor__editable_inline {
      min-height: 400px;
    }

    /* Target the exact internal structure of CKEditor to bypass all external resets */
    div.ck.ck-editor__main > div.ck-editor__editable h2 {
        display: block !important;
        font-size: 28px !important;
        font-weight: 900 !important;
        margin: 20px 0 10px 0 !important;
        line-height: 1.2 !important;
        color: #000 !important;
        background: transparent !important;
        border: none !important;
    }

    div.ck.ck-editor__main > div.ck-editor__editable h3 {
        display: block !important;
        font-size: 24px !important;
        font-weight: 800 !important;
        margin: 18px 0 8px 0 !important;
        line-height: 1.2 !important;
        color: #222 !important;
    }

    div.ck.ck-editor__main > div.ck-editor__editable h4 {
        display: block !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        margin: 16px 0 8px 0 !important;
        line-height: 1.2 !important;
        color: #333 !important;
    }

    div.ck.ck-editor__main > div.ck-editor__editable p {
        display: block !important;
        font-size: 16px !important;
        line-height: 1.6 !important;
        margin-bottom: 12px !important;
    }

    div.ck.ck-editor__main > div.ck-editor__editable ul {
        list-style-type: disc !important;
        padding-left: 24px !important;
        margin-bottom: 16px !important;
    }

    div.ck.ck-editor__main > div.ck-editor__editable ol {
        list-style-type: decimal !important;
        padding-left: 24px !important;
        margin-bottom: 16px !important;
    }
    </style>
    @include('admin.partials.top_nav')
    @include('admin.partials.nav')

    <!-- ...title bars unchanged... -->
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Novel</li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
            {{$title}}
            </h1>
            <a href="{{ url()->previous() }}" data-target="add-facility-modal" class="button blue --jb-modal">Go Back</a>
        </div>
    </section>

    <section class="section main-section">
        @if(session('success'))
            <!-- ...success notification unchanged... -->
            <div class="notification green">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer"></i></span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="button small textual --jb-notification-dismiss">Dismiss </button>
                </div>
            </div>
        @endif
        <div class="card-content">
            <form method="POST" action="{{ route('admin.novels.storeChapter', ['novelId' => $chapter->novel_id, 'chapterId' => $chapter->id]) }}">
                @csrf
                <input type="hidden" name="home_id" value="">
                <div class="field">
                    <label class="label">Chapter Title</label>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Chapter Title" name="title" value="{{ old('title', $chapter->title) }}">
                            </div>
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Chapter Number</label>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="number" placeholder="Chapter Number" name="chapter_number" value="{{ old('chapter_number', $chapter->chapter_number) }}">
                            </div>
                            @error('chapter_number')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Chapter Description</label>
                    <div class="control">
                    <textarea class="textarea description" placeholder="Enter Text" name="description">{{old('description', $chapter->description)}}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field" style="margin-top: 20px">
                    <label class="label">Status</label>
                    <div class="field-body">
                        <div class="field grouped multiline">
                            <div class="control">
                                <label class="radio">
                                <input type="radio" name="is_active" value="1" {{ old('is_active', $chapter->is_active) == 1 ? 'checked' : '' }}>
                                <span class="check"></span>
                                <span class="control-label">Active</span>
                                </label>
                            </div>
                            <div class="control">
                                <label class="radio">
                                <input type="radio" name="is_active" value="0" {{ old('is_active', $chapter->is_active) == 0 ? 'checked' : '' }}>
                                <span class="check"></span>
                                <span class="control-label">Inactive</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('is_active')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field grouped" style="margin-top: 20px">
                    <div class="control">
                        <button type="submit" class="button blue">
                            Save Changes
                        </button>
                    </div>
                    <div class="control">
                        <button type="reset" class="button red">
                            Reset
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</div>

{{-- <div id="ajaxLoader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div> --}}
<div id="ajaxLoader"></div>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="{{ asset('js/rich-editor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeRichEditor('.textarea.description');
        });
    </script>
@endsection
