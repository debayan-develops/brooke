@extends('layouts.admin')

@section('title', $title)

<style>
    .ck-content ol, .ck-content ul {
        margin-left: 20px !important;
        padding-left: 20px !important;
    }
    .ck-content ol { list-style-type: decimal !important; }
    .ck-content ul { list-style-type: disc !important; }
    .ck-content li { margin-bottom: 5px; }
    
    /* RESTORED LARGE HEIGHT HERE */
    .ck-editor__editable_inline { 
        min-height: 400px !important; 
    }
</style>

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    
    /* Custom Radio Button Styles (For Active/Inactive) */
    .custom-radio {
        display: inline-flex !important;
        align-items: center !important;
        cursor: pointer !important;
        position: relative !important;
        margin-right: 20px;
    }
    .custom-radio input[type="radio"] {
        position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0;
    }
    .radio-circle {
        height: 20px !important; width: 20px !important;
        background-color: #fff !important;
        border: 2px solid #ccc !important;
        border-radius: 50% !important;
        display: inline-block !important;
        position: relative !important;
        transition: all 0.2s ease-in-out;
    }
    .custom-radio input:checked ~ .radio-circle {
        background-color: #2563eb !important; border-color: #2563eb !important;
    }
    .radio-circle::after {
        content: ""; position: absolute; display: none;
        top: 5px; left: 5px; width: 6px; height: 6px;
        border-radius: 50%; background: white;
    }
    .custom-radio input:checked ~ .radio-circle::after { display: block !important; }
    .radio-text {
        margin-left: 8px !important; font-weight: 500 !important; color: #333 !important;
    }

    /* Form Styles */
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
    .form-hint { font-size: 0.875rem; color: #6B7280; }
    .form-input { width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; box-sizing: border-box; }
</style>

@section('content')
    <div id="app">
        @include('admin.partials.top_nav')
        @include('admin.partials.nav')

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
                <a href="{{ url()->previous() }}" class="button blue">Go Back</a>
            </div>
        </section>

        <section class="section main-section">
            <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    Enter Novel Details
                </p>
            </header>
            <div class="card-content">
                
                @if ($errors->any())
                    <div class="notification is-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.addNovels.add') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="home_id" value="">
                    
                    <div class="field" style="margin-top: 20px">
                        <label class="label">Content View Permission</label>
                        <div class="field-body">
                            <div class="field grouped multiline">
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="permission" value="1" checked>
                                    <span class="check"></span>
                                    <span class="control-label">Public</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="permission" value="0">
                                    <span class="check"></span>
                                    <span class="control-label">Registered User</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="permission" value="2">
                                    <span class="check"></span>
                                    <span class="control-label">Paid User</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Title</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" placeholder="Story Name" name="title" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Author Name</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" placeholder="Name" name="author" value="{{ old('author') }}">
                                </div>
                                @error('author')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="thumbnailPhoto" class="label">
                            Upload Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <input id="thumbnailPhoto" type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp" class="form-input" />
                    </div>

                    <div class="form-group">
                        <label for="bannerPhoto" class="label">
                            Upload Banner Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <input id="bannerPhoto" type="file" name="banner_image" accept=".jpg,.jpeg,.png,.webp" class="form-input" />
                    </div>

                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label"> Tags</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tagType" multiple name="tags[]">
                                            @if(isset($tags) && count($tags) > 0)
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('tags')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Related Novels</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="relatedNovels" multiple name="relatedNovels[]">
                                            @if(isset($relatedNovels) && count($relatedNovels) > 0)
                                                @foreach($relatedNovels as $novel)
                                                    <option value="{{ $novel->id }}">{{ $novel->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('relatedNovels')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Short Description</label>
                        <div class="control">
                        <textarea class="textarea description" placeholder="Enter Text" name="description" rows="4">{{old('description')}}</textarea>
                        </div>
                        @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">About Story</label>
                        <div class="control">
                        <textarea class="textarea about_story" placeholder="Enter Text" name="about_story">{{old('about_story')}}</textarea>
                        </div>
                        @error('about_story')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="field" style="margin-top: 20px;">
                        <label class="label">Status</label>
                        <div class="control" style="display: flex; gap: 20px; align-items: center;">
                            <label class="custom-radio">
                                <input type="radio" name="status" value="1" checked>
                                <span class="radio-circle"></span>
                                <span class="radio-text">Active</span>
                            </label>
                            <label class="custom-radio">
                                <input type="radio" name="status" value="0">
                                <span class="radio-circle"></span>
                                <span class="radio-text">Inactive</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="field grouped" style="margin-top: 30px;">
                        <div class="control">
                        <button type="submit" class="button green">
                            Next
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
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Choices.js
            new Choices('#tagType', { removeItemButton: true, searchEnabled: true });
            new Choices('#relatedNovels', { removeItemButton: true, searchEnabled: true });

            // Initialize CKEditor for Short Description
            ClassicEditor
                .create( document.querySelector( '.textarea.description' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch( error => { console.error( error ); } );

            // Initialize CKEditor for About Story
            ClassicEditor
                .create( document.querySelector( '.textarea.about_story' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch( error => { console.error( error ); } );
        });
    </script>
@endsection