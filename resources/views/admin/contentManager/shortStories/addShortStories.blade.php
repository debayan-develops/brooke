@extends('layouts.admin')

@section('title', $title)

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    /* Custom styles for Choices.js */
</style>

@section('content')
<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    /* Override default Choices.js styles */
    .textarea.introducing {
        height: 15rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #374151; /* Tailwind's gray-700 */
    }

    .form-hint {
        font-size: 0.875rem;
        color: #6B7280; /* Tailwind's gray-500 */
    }

    .form-input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #D1D5DB; /* Tailwind's border-gray-300 */
        border-radius: 0.375rem; /* Tailwind's rounded */
        box-sizing: border-box;
    }

    .preview-box {
        margin-top: 0.5rem;
    }

    .error-text {
        color: #EF4444; /* Tailwind's red-500 */
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

</style>
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
            </div>
        </section>

        <section class="section main-section">
            <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    Enter Short Story
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('admin.addShortStories.add') }}" enctype="multipart/form-data">
                    @csrf
                    
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
                        <label class="label">Short description</label>
                        <div class="control">
                            <textarea class="textarea editor" placeholder="Enter Text" name="short_description">{{old('short_description')}}</textarea>
                        </div>
                        @error('short_description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        
                    </div>

                    <!-- Thumbnail Photo -->
                    <div class="form-group">
                        <label for="thumbnailPhoto" class="label">
                            Upload Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <input id="thumbnailPhoto" type="file" accept="image/*" class="form-input" name="thumbnail_photo" />
                        <div id="thumbnailPreview" class="preview-box"></div>
                        <p id="thumbnailError" class="error-text hidden"></p>
                        @error('thumbnail_photo')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label"> Tags</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tags" multiple name="tags[]">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                            
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
                                <label class="label">Category</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="categories" multiple name="categories[]">
                                           @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('categories')
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
                                <label class="label">Characters</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="characters" multiple name="characters[]">
                                            @foreach($characters as $character)
                                                <option value="{{ $character->id }}">{{ $character->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('characters')
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
                                <label class="label">Suggested Stories</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="suggestedStories" multiple name="suggestedStories[]">
                                            @foreach($suggestedStories as $story)
                                                <option value="{{ $story->id }}">{{ $story->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('suggested_stories')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Short Story Details</label>
                        <div class="control">
                        <textarea class="textarea editor2" placeholder="Enter Text" name="short_story_details">{{old('short_story_details')}}</textarea>
                        </div>
                        @error('short_story_details')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
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
                    
                    <div class="field grouped">
                        <div class="control">
                        <button type="submit" class="button green">
                            Submit
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
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            // Initialize Choices.js
            new Choices('#tags', { removeItemButton: true, searchEnabled: true });
            new Choices('#categories', { removeItemButton: true, searchEnabled: true });
            new Choices('#suggestedStories', { removeItemButton: true, searchEnabled: true });
            new Choices('#characters', { removeItemButton: true, searchEnabled: true });

            // Common CKEditor configuration for better text formatting
            const editorConfig = {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ]
                },
                language: 'en'
            };

            // Initialize Editor 1 (Short Description)
            ClassicEditor
            .create(document.querySelector('.editor'), editorConfig)
            .catch(error => { console.error(error); });

            // Initialize Editor 2 (Details)
            ClassicEditor
            .create(document.querySelector('.editor2'), editorConfig)
            .catch(error => { console.error(error); });
            
            // Thumbnail Preview Logic
            const thumbnailInput = document.getElementById('thumbnailPhoto');
            if(thumbnailInput) {
                thumbnailInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const previewBox = document.getElementById('thumbnailPreview');
                    const errorText = document.getElementById('thumbnailError');
                    
                    // Clear previous
                    previewBox.innerHTML = '';
                    errorText.classList.add('hidden');

                    if (file) {
                        // Validate size (2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            errorText.textContent = "File is too large (Max 2MB)";
                            errorText.classList.remove('hidden');
                            this.value = ''; // Reset input
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '200px';
                            img.style.borderRadius = '8px';
                            img.style.marginTop = '10px';
                            previewBox.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection