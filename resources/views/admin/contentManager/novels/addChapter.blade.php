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
  body {
    /* margin: 0;
    font-family: system-ui, sans-serif;
    background: var(--bg);
    color: #111827;
    padding: 32px 16px;
    display: grid;
    gap: 32px;
    place-items: start center; */
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
  .ck-editor__editable_inline {
    min-height: 400px;
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
            <form method="POST" id="addChapterForm" action="{{ route('admin.novels.storeChapter', ['novelId' => $novelId]) }}">
                @csrf
                <input type="hidden" name="home_id" value="">
                <div class="field">
                    <label class="label">Chapter Title</label>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Chapter Title" name="title" value="{{ old('title') }}">
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
                                <input class="input" type="number" placeholder="Chapter Number" name="chapter_number" value="{{ old('chapter_number') }}">
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
                    <textarea class="textarea description" placeholder="Enter Text" name="description">{{old('description')}}</textarea>
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
                                <input type="radio" name="is_active" value="1" checked>
                                <span class="check"></span>
                                <span class="control-label">Active</span>
                                </label>
                            </div>
                            <div class="control">
                                <label class="radio">
                                <input type="radio" name="is_active" value="0">
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
                            Add More
                        </button>
                    </div>
                    <div class="control">
                        <button type="reset" id="resetBtn" class="button red">
                            Reset
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
        {{-- <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    Upload Slider Images
                </p>
            </header>
            <div class="card-content">
                
                <!-- Gallery Images AJAX Form -->
                <form id="galleryImagesForm" enctype="multipart/form-data">
                    <div class="uploader">
                        <h2>Upload Slider Images</h2>
                        <p class="hint">Select one or more images (Max: 6)</p>
                        <div id="drop2" class="dropzone" onclick="document.getElementById('galleryImagesInput').click();">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            </svg>
                            <small>click to Upload Images</small>
                            <input type="file" accept="image/*" multiple id="galleryImagesInput" name="images[]" hidden>
                        </div>
                        <div class="grid-1" id="galleryImagesPreview">
                            <!-- Previews will be inserted here -->
                        </div>
                        <div class="error" id="galleryImagesError"></div>
                        <input type="hidden" name="home_id" value="">
                        <button type="submit" class="btn mt-2">Upload Slider Images</button>
                    </div>
                </form>
                
                            
                
            </div>
        </div> --}}

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
                            <th>Is Featured</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        //    print_r($images->toArray());die;
                        @endphp
                        @foreach($images->toArray() as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> 
                                <div class="thumb" style="width: 120px; height: 80px;">
                                    <img src="{{ $row['url'] }}" class="preview">
                                </div>
                            </td>
                            <td> 
                                <div class="field">
                                {{-- <label class="label">Select</label> --}}
                                    <div class="field-body">
                                        <div class="field">
                                        <label class="switch">
                                            <input type="checkbox" name="featured" value="1"
                                            {{ $row['is_featured'] ? 'checked' : '' }}>
                                            <span class="check"></span>
                                            <span class="control-label">Featured</span>
                                        </label>
                                        </div>
                                    </div>
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
                <div class="table-pagination">
                    <div class="flex items-center justify-between">
                        {{-- <div class="buttons">
                        <button type="button" class="button active">1</button>
                        <button type="button" class="button">2</button>
                        <button type="button" class="button">3</button>
                        </div>
                        <small>Page 1 of 3</small> --}}
                    </div>
                </div>
            </div>
            @else
            {{-- <div class="card empty">
                <div class="card-content">
                    <div>
                        <span class="icon large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                    </div>
                    <p>Nothing's here…</p>
                </div>
            </div> --}}
            <div class="card-content">
                <table>
                    <thead>
                    <tr>
                        <th>Chapter No.</th>
                        {{-- <th>Image</th> --}}
                        <th>Chapter Title</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($chapters as $index => $chapter)
                        <tr>
                            <td>{{ $chapter->chapter_number }}</td>
                            {{-- <td> 
                                <div class="thumb" style="width: 120px; height: 80px;">
                                    <img src="https://brookehennen.com/14thjuly/images/Indiana-Everglades-Icon-and-Banner-for-Articles.jpg" alt="Thumbnail" width="80" height="80" class="w-16 h-16 object-cover rounded-md" />
                                </div>
                            </td> --}}
                            <td>
                                {{ $chapter->title }}
                            </td>
                            <td>
                                <div class="buttons right nowrap">
                                    <a href="{{ route('admin.novels.editChapter', ['novelId' => $novelId, 'chapterId' => $chapter->id]) }}" class="button small blue">
                                        <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                    </a>
                                    <a href="javascript:void(0)" class="edit-btn button small blue mr-1"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span> <span style="display:inline-flex; align-items:center; justify-content:left; width:4.1rem">Add Slider</span></a>
                                    <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
            @endif
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
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editorInstance; // store editor reference

        ClassicEditor
            .create(document.querySelector('.textarea.description'))
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

        $('#resetBtn').on('click', function () {

            // Reset normal inputs
            $('#addChapterForm')[0].reset();
            // Reset CKEditor
            // Reset CKEditor content
            if (editorInstance) {
                editorInstance.setData('');
            }
        });

    });
</script>
@endsection
