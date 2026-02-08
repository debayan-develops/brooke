@extends('layouts.admin')

@section('title', $title)

<!-- Styles -->
<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    
    /* Form & Layout Styling */
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
    .form-hint { font-size: 0.875rem; color: #6B7280; }
    .form-input { width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; box-sizing: border-box; }
    .preview-box { margin-top: 0.5rem; }
    
    /* Error Text Styling */
    .error-text { 
        color: #EF4444; /* Red color */
        font-size: 0.875rem; 
        margin-top: 0.5rem; 
        font-weight: 600;
    }
    .hidden { display: none; }

    /* Modern CKEditor Styling */
    .ck-editor__editable_inline {
        min-height: 400px; /* Taller editor */
        border-bottom-left-radius: 0.5rem !important;
        border-bottom-right-radius: 0.5rem !important;
        border: 1px solid #D1D5DB !important;
        padding: 1.5rem !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        color: #374151;
    }
    /* FIX: Content Headings in Admin CKEditor */
    .ck-editor__editable h2 { 
        font-size: 1.875rem !important; /* 30px */
        font-weight: 800 !important; 
        color: #111827; 
        margin-top: 1.5em !important; 
        margin-bottom: 0.8em !important; 
        line-height: 1.3 !important;
    }
    .ck-editor__editable h3 { 
        font-size: 1.5rem !important; /* 24px */
        font-weight: 700 !important; 
        color: #374151; 
        margin-top: 1.2em !important; 
        margin-bottom: 0.6em !important; 
        line-height: 1.3 !important;
    }
    .ck-editor__editable h4 { 
        font-size: 1.25rem !important; /* 20px */
        font-weight: 600 !important; 
        color: #4B5563; 
        margin-top: 1em !important; 
        margin-bottom: 0.5em !important; 
    }
    .ck-toolbar {
        border-top-left-radius: 0.5rem !important;
        border-top-right-radius: 0.5rem !important;
        border: 1px solid #D1D5DB !important;
        border-bottom: none !important;
        background-color: #F9FAFB !important;
        padding: 0.5rem !important;
    }
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
                <h1 class="title">{{$title}}</h1>
            </div>
        </section>

        <section class="section main-section">
            <div class="card mb-6">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-ballot"></i></span>
                        Edit Blog Details
                    </p>
                </header>
                <div class="card-content">
                    <!-- FIX: Use the named route 'admin.editBlogs.update' which we will add to routes -->
                    <form method="POST" action="{{ route('admin.editBlogs.update', $blog->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="field">
                            <label class="label">Title</label>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Blog title" name="title" value="{{ old('title', $blog->title) }}">
                                    </div>
                                    @error('title')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
<div class="field">
    <label class="label">Article Type</label>
    <div class="control">
        <div class="select is-fullwidth">
            <select name="article_type">
                <option value="Blog" {{ (isset($blog) && $blog->article_type == 'Blog') ? 'selected' : '' }}>Blog</option>
                <option value="Journal" {{ (isset($blog) && $blog->article_type == 'Journal') ? 'selected' : '' }}>Journal</option>
            </select>
        </div>
    </div>
</div>
                        <!-- Thumbnail Photo Upload with Preview -->
                        <div class="form-group">
                            <label for="thumbnailPhoto" class="label">
                                Upload Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                            </label>
                            <input id="thumbnailPhoto" name="thumbnail_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-input" />
                            
                            <div id="thumbnailPreview" class="preview-box">
                                @if($blog->thumbnail_photo)
                                    <img src="{{ asset(config('app.assets_path') . $blog->thumbnail_photo) }}" style="max-width: 200px; border-radius: 8px; margin-top: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                @endif
                            </div>
                            <p id="thumbnailError" class="error-text hidden"></p>

                            @error('thumbnail_photo')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dropdowns (Choices.js) -->
                        <div class="field">
                            <label class="label">Tags</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="tags" multiple name="tags[]">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ $blog->blogTags->contains($tag->id) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tags') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Category Type</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="categories" multiple name="categories[]">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $blog->blogCategories->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categories') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- <div class="field">
                            <label class="label">Article Type</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="blogTypes" multiple name="blogTypes[]">
                                        @foreach ($blogTypes as $type)
                                            <option value="{{ $type->id }}" {{ $blog->blogTypes->contains($type->id) ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blogTypes') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div> -->

                        <div class="field">
                            <label class="label">Suggested Articles</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="suggestedArticles" multiple name="suggestedArticles[]">
                                        @foreach ($suggestedBlogs as $sBlog)
                                            <!-- <option value="{{ $sBlog->id }}" {{ $blog->suggestedBlogs->contains($sBlog->id) ? 'selected' : '' }}>
                                                {{ $sBlog->title }}
                                            </option> -->
                                                                                @if($sBlog->id != $blog->id)
                                        <option value="{{ $sBlog->id }}" 
                                            {{ in_array($sBlog->id, $blog->suggestedBlogs->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $sBlog->title }}
                                        </option>
                                    @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('suggestedArticles') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Modern CKEditor -->
                        <div class="field">
                            <label class="label">Blog Details</label>
                            <div class="control">
                                <textarea class="textarea editor" id="blog_details" name="blog_details">{{ old('blog_details', $blog->blog_details) }}</textarea>
                            </div>
                            @error('blog_details')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div class="field">
                            <label class="label">Status</label>
                            <div class="field-body">
                                <div class="field grouped multiline">
                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="status" value="1" {{ $blog->status == 1 ? 'checked' : '' }}>
                                            <span class="check"></span>
                                            <span class="control-label">Publish</span>
                                        </label>
                                    </div>
                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="status" value="0" {{ $blog->status == 0 ? 'checked' : '' }}>
                                            <span class="check"></span>
                                            <span class="control-label">Draft</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        
    <div class="form-group mt-4" style="display: flex; flex-wrap: wrap; gap: 15px; padding: 20px 0; align-items: center;">
    
    <button type="submit" 
            class="btn" 
            style="background-color: #0056b3 !important; color: white !important; border: 1px solid #0056b3; border-radius: 5px; padding: 10px 20px;">
        Update & Next Step <i class="fa fa-arrow-right"></i>
    </button>

    <button type="submit" 
            name="action" 
            value="save_and_exit" 
            class="btn" 
            style="background-color: #17a2b8 !important; color: white !important; border: 1px solid #17a2b8; border-radius: 5px; padding: 10px 20px;">
        <i class="fa fa-check"></i> Update & Finish
    </button>

    <a href="{{ route('admin.blogs') }}" 
       class="btn" 
       style="background-color: #dc3545 !important; color: white !important; border: 1px solid #dc3545; border-radius: 5px; padding: 10px 20px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
        Cancel
    </a>

</div>
</form>

    <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Initialize Choices.js (Dropdowns)
            new Choices('#tags', { removeItemButton: true, searchEnabled: true });
            new Choices('#categories', { removeItemButton: true, searchEnabled: true });
            new Choices('#suggestedArticles', { removeItemButton: true, searchEnabled: true });
            // Note: If you have an element with ID 'blogTypes', uncomment the line below
            // new Choices('#blogTypes', { removeItemButton: true, searchEnabled: true });

            // 2. CKEditor Configuration (Replicated from Short Stories)
            const editorConfig = {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ]
                },
                language: 'en',
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                }
            };

            // 3. Initialize Editor
            // Targeting the ID '#blog_details' is safer than class '.editor'
            ClassicEditor
                .create(document.querySelector('#blog_details'), editorConfig)
                .then(editor => {
                    console.log('Blog Editor initialized', editor);
                })
                .catch(error => {
                    console.error('Editor initialization error:', error);
                });

            // 4. Thumbnail Preview Logic (Preserved)
            const thumbnailInput = document.getElementById('thumbnailPhoto');
            if(thumbnailInput) {
                thumbnailInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const previewBox = document.getElementById('thumbnailPreview');
                    const errorText = document.getElementById('thumbnailError');
                    
                    previewBox.innerHTML = '';
                    errorText.classList.add('hidden');
                    errorText.textContent = '';

                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            errorText.textContent = "Error: File size is too large (Max 2MB).";
                            errorText.classList.remove('hidden');
                            this.value = ''; 
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '200px';
                            img.style.borderRadius = '8px';
                            img.style.marginTop = '10px';
                            img.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                            previewBox.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection