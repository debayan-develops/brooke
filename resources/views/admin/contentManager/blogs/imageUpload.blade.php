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
  h2 { margin: 0 0 8px; font-size: 1.1rem; }
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
</style>
    @include('admin.partials.top_nav')
    @include('admin.partials.nav')

    <!-- ...title bars unchanged... -->
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
            {{$title}}
            </h1>
            {{-- FIX: Changed to point to the Edit Route directly instead of previous() --}}
            <a href="{{ route('admin.editBlogs', $blogId) }}" class="button blue">Finish & Go Back</a>
        </div>
    </section>

    <section class="section main-section">
        @if(session('success'))
             <div class="notification green">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer"></i></span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                </div>
            </div>
        @endif
        <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    Upload Slider Images
                </p>
            </header>
            <div class="card-content">
                <!-- Gallery Images AJAX Form -->
                <form id="galleryImagesForm" method="POST" action="{{ route('admin.blogImageUpload.store',['id' => $blogId]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="uploader">
                        <h2>Gallery Images</h2>
                        <p class="hint">Select one or more images (Max: 6)</p>
                        <div id="drop2" class="dropzone" onclick="document.getElementById('galleryImagesInput').click();">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            </svg>
                            <small>click to Upload Images</small>
                            <input type="file" accept="image/*" multiple id="galleryImagesInput" name="slider_images[]" hidden>
                        </div>
                        <div class="grid-1" id="galleryImagesPreview">
                            <!-- Previews will be inserted here -->
                        </div>
                        <div class="error" id="galleryImagesError"></div>
                        @error('slider_images')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="blog_id" value="{{ $blogId }}">
                        <button type="submit" class="btn mt-2">Upload Slider Images</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                    List
                    </p>
                    <a href="#" class="card-header-icon">
                    <span class="icon"><i class="mdi mdi-reload"></i></span>
                    </a>
                </header>
                @if ($images)
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>SL no.</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images->toArray() as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td> 
                                    <div class="thumb" style="width: 120px; height: 80px;">
                                        {{-- FIX: Changed asset path to storage --}}
                                        <img src="{{ asset(config('app.assets_path') . $row['image_path']) }}" class="preview">
                                    </div>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <button class="delete-btn button small red" data-id="{{$row['id']}}" onclick="deleteGalleryImage('{{$row['id']}}', this)" type="button">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card empty">
                    <div class="card-content">
                        <div>
                            <span class="icon large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                        </div>
                        <p>Nothing's here…</p>
                    </div>
                </div>
                @endif
            </div>
    </section>
</div>

<div id="ajaxLoader"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for handling image uploads and previews
    document.getElementById('galleryImagesInput').addEventListener('change', function(e) {
        let previewDiv = document.getElementById('galleryImagesPreview');
        previewDiv.innerHTML = '';
        let files = this.files;
        if (files.length > 6) {
            previewDiv.innerHTML = '<div class="error">You can upload a maximum of 6 images.</div>';
            return;
        }
        Array.from(files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(ev) {
                let thumb = document.createElement('div');
                thumb.className = 'thumb';
                thumb.innerHTML = `<img src="${ev.target.result}" class="preview">`;
                previewDiv.appendChild(thumb);
            };
            reader.readAsDataURL(file);
        });
    });

    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Delete this image?')) return;
            $('#ajaxLoader').fadeIn();
            let btn = e.target.closest('.delete-btn');
            let id = btn.getAttribute('data-id');
            fetch(`{{ url('admin/blogs/image-upload/delete') }}/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value }
            })
            .then(res => res.json())
            .then(data => {
                $('#ajaxLoader').fadeOut();
                if (data.success) {
                    btn.parentElement.parentElement.parentElement.remove();
                    alert('Image deleted successfully');
                }
                window.location.reload();
            });
        });
    });
});
</script>
@endsection