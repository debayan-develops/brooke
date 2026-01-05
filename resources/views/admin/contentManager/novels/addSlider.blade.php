@extends('layouts.admin')

@section('title', 'Chapter Slider')

<style>
    .thumb-grid { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
    .thumb-item { position: relative; width: 180px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; background: #fff; }
    .thumb-img-container { position: relative; height: 100px; overflow: hidden; border-bottom: 1px solid #eee; }
    .thumb-img-container img { width: 100%; height: 100%; object-fit: cover; }
    
    .delete-overlay { 
        position: absolute; top: 5px; right: 5px; 
        background: rgba(255, 0, 0, 0.8); color: white; 
        border-radius: 50%; width: 25px; height: 25px; 
        display: flex; align-items: center; justify-content: center; 
        cursor: pointer; 
        border: none;
    }
    .delete-overlay:hover { background: red; }
</style>

@section('content')
<div id="app">
    @include('admin.partials.top_nav')
    @include('admin.partials.nav')

    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Novels</li>
                <li>{{ $chapter->title }}</li>
                <li>Slider Images</li>
            </ul>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Slider Images for: {{ $chapter->title }}
            </h1>
            <a href="{{ route('admin.addChapter', $chapter->novel_id) }}" class="button blue">Go Back</a>
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
                    <span class="icon"><i class="mdi mdi-upload"></i></span>
                    Upload New Images
                </p>
            </header>
            <div class="card-content">
                <form action="{{ route('admin.novels.storeChapterSlider', $chapter->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <label class="label">Select Images (Can select multiple)</label>
                        <div class="control">
                            <input class="input" type="file" name="images[]" multiple accept="image/*" required>
                        </div>
                        <p class="help">Supported: JPG, PNG, WEBP. Max 2MB.</p>
                    </div>
                    <div class="field">
                        <button type="submit" class="button green">
                            <span class="icon"><i class="mdi mdi-cloud-upload"></i></span>
                            <span>Upload Images</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-image-multiple"></i></span>
                    Existing Slider Images
                </p>
            </header>
            <div class="card-content" style="padding: 20px;">
                @if($sliderImages->count() > 0)
                    <div class="thumb-grid">
                        @foreach($sliderImages as $img)
                            <div class="thumb-item">
                                <div class="thumb-img-container">
                                    <img src="{{ asset(config('app.assets_path') . $img->image_path) }}" alt="Slider Image">
                                    
                                    <form action="{{ route('admin.novels.deleteChapterSliderImage', $img->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-overlay" title="Delete Image">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </form>
                                </div>

                                <form action="{{ route('admin.novels.updateChapterSliderImage', $img->id) }}" method="POST" style="padding: 10px;">
                                    @csrf
                                    <div class="field" style="margin-bottom: 8px;">
                                        <div class="control">
                                            <input class="input is-small" type="text" name="title" placeholder="Image Title" value="{{ $img->title }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="button is-small blue is-fullwidth">
                                        Save Title
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="has-text-grey has-text-centered p-4">No slider images uploaded yet.</p>
                @endif
            </div>
        </div>

    </section>
</div>
@endsection