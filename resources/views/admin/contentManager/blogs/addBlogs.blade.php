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

    /* =========================================
       MODERN CKEDITOR 5 STYLING 
       ========================================= */
    /* Main Container */
    .ck-editor__editable_inline {
        min-height: 400px;
        padding: 2rem !important; /* Spacious padding like a document */
        border: 1px solid #D1D5DB !important;
        border-bottom-left-radius: 0.5rem !important;
        border-bottom-right-radius: 0.5rem !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        font-size: 16px;
        line-height: 1.8;
        color: #374151;
    }

    /* Toolbar Styling */
    .ck-toolbar {
        border: 1px solid #D1D5DB !important;
        border-bottom: none !important;
        border-top-left-radius: 0.5rem !important;
        border-top-right-radius: 0.5rem !important;
        background-color: #F9FAFB !important; /* Light gray header */
        padding: 0.5rem !important;
    }

    /* Focus State - Blue Ring */
    .ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-focused {
        border-color: #3B82F6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
        outline: none !important;
    }

    /* Content Headings */
    .ck-content h2 { font-size: 1.75em; font-weight: 700; margin-top: 1.5em; margin-bottom: 0.5em; color: #111827; }
    .ck-content h3 { font-size: 1.5em; font-weight: 600; margin-top: 1.2em; margin-bottom: 0.5em; color: #1F2937; }
    .ck-content blockquote {
        border-left: 4px solid #3B82F6;
        padding-left: 1em;
        margin-left: 0;
        font-style: italic;
        color: #4B5563;
        background: #F3F4F6;
        padding: 1rem;
        border-radius: 0 0.5rem 0.5rem 0;
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
                        Enter Blog Details
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.addBlogs.add') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="field">
                            <label class="label">Title</label>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Blog title" name="title" value="{{ old('title') }}">
                                    </div>
                                    @error('title')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail Photo Upload with Preview & Error Message -->
                        <div class="form-group">
                            <label for="thumbnailPhoto" class="label">
                                Upload Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                            </label>
                            <input id="thumbnailPhoto" name="thumbnail_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-input" />
                            
                            <!-- Preview Container -->
                            <div id="thumbnailPreview" class="preview-box"></div>
                            
                            <!-- Error Message Container -->
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
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categories') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Article Type</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="blogTypes" multiple name="blogTypes[]">
                                        @foreach ($blogTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blogTypes') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Suggested Articles</label>
                            <div class="control icons-left icons-right">
                                <div class="select">
                                    <select id="suggestedArticles" multiple name="suggestedArticles[]">
                                        @foreach ($suggestedBlogs as $blog)
                                            <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('suggestedArticles') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- ADVANCED CKEDITOR 5 -->
                        <div class="field">
                            <label class="label">Blog Details</label>
                            <div class="control">
                                <textarea class="textarea editor" id="blog_details" placeholder="Start writing your blog post..." name="blog_details">{{old('blog_details')}}</textarea>
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
                                            <input type="radio" name="status" value="1" checked>
                                            <span class="check"></span>
                                            <span class="control-label">Publish</span>
                                        </label>
                                    </div>
                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="status" value="0">
                                            <span class="check"></span>
                                            <span class="control-label">Draft</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="field grouped">
                            <div class="control">
                                <button type="submit" class="button green">Submit</button>
                            </div>
                            <div class="control">
                                <button type="reset" class="button red">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    
    <!-- CKEditor 5 Main Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Initialize Choices.js
            new Choices('#tags', { removeItemButton: true, searchEnabled: true });
            new Choices('#categories', { removeItemButton: true, searchEnabled: true });
            new Choices('#suggestedArticles', { removeItemButton: true, searchEnabled: true });
            new Choices('#blogTypes', { removeItemButton: true, searchEnabled: true });

            // 2. Initialize Advanced & Modern CKEditor
            ClassicEditor
                .create(document.querySelector('.editor'), {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'code',
                            '|',
                            'bulletedList', 'numberedList', 'todoList',
                            '|',
                            'outdent', 'indent',
                            '|',
                            'link', 'blockQuote', 'insertTable', 'mediaEmbed',
                            '|',
                            'undo', 'redo'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    language: 'en',
                    placeholder: 'Start writing your amazing content here...',
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    }
                })
                .then(editor => {
                    console.log('Advanced Editor initialized', editor);
                })
                .catch(error => {
                    console.error('Editor initialization error:', error);
                });

            // 3. Thumbnail Preview & Validation Logic
            const thumbnailInput = document.getElementById('thumbnailPhoto');
            if(thumbnailInput) {
                thumbnailInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const previewBox = document.getElementById('thumbnailPreview');
                    const errorText = document.getElementById('thumbnailError');
                    
                    // Clear previous state
                    previewBox.innerHTML = '';
                    errorText.classList.add('hidden');
                    errorText.textContent = '';

                    if (file) {
                        // Validate size (2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            errorText.textContent = "Error: File size is too large. Please upload an image under 2MB.";
                            errorText.classList.remove('hidden');
                            this.value = ''; // Reset input so user must select again
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