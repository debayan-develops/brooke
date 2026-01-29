@extends('layouts.admin')

@section('title', $title)

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    
    /* CKEditor List Fixes */
    .ck-content ol, .ck-content ul {
        margin-left: 20px !important;
        padding-left: 20px !important;
    }
    .ck-content ol { list-style-type: decimal !important; }
    .ck-content ul { list-style-type: disc !important; }
    .ck-content li { margin-bottom: 5px; }

    /* Choices.js Custom Overrides for this theme */
    .choices__inner {
        background-color: #fff;
        border: 1px solid #dbdbdb;
        border-radius: 4px;
        min-height: 40px;
    }
    .choices__input { background-color: transparent !important; }
</style>

@section('content')
<style>
    /* Design consistency overrides */
    .textarea.introducing { height: 15rem; }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
    .form-hint { font-size: 0.875rem; color: #6B7280; }
    .preview-box { margin-top: 0.5rem; }
    .error-text { color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem; }
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
                    Edit Short Story
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ url('admin/short-stories/update/' . $shortStory->id) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" placeholder="Story Name" name="title" value="{{ old('title', $shortStory->title) }}">
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
                            <textarea class="textarea editor" placeholder="Enter Text" name="short_description">{{ old('short_description', $shortStory->short_description) }}</textarea>
                        </div>
                        @error('short_description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" style="padding: 10px 0;">
                        <label for="thumbnailPhoto" class="label">
                            Change Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <div class="file has-name is-fullwidth">
                            <label class="file-label">
                                <input class="file-input" id="thumbnailPhoto" type="file" accept="image/*" name="thumbnail_photo">
                                <span class="file-cta">
                                    <span class="file-icon"><i class="mdi mdi-upload"></i></span>
                                    <span class="file-label">Choose a file…</span>
                                </span>
                                <span class="file-name" id="fileNameDisplay">No file selected</span>
                            </label>
                        </div>
                        
                        <div id="thumbnailPreview" class="preview-box">
                            @if($shortStory->thumbnail_photo)
                                <img src="{{ asset('storage/' . $shortStory->thumbnail_photo) }}" alt="Thumbnail" style="max-width: 200px; border-radius: 8px;">
                            @endif
                        </div>
                        <p id="thumbnailError" class="error-text hidden"></p>
                    </div>

                    <div class="field">
                        <label class="label">Tags</label>
                        <div class="control">
                            <select id="tags" multiple name="tags[]">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $shortStory->shortStoryTags->pluck('id')->toArray())))>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Category</label>
                        <div class="control">
                            <select id="categories" multiple name="categories[]">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $shortStory->shortStoryCategories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Characters</label>
                        <div class="control">
                            <select id="characters" multiple name="characters[]">
                                @foreach($allCharacters as $character)
                                    <option value="{{ $character->id }}" 
                                        {{ in_array($character->id, $shortStory->shortStoryCharacters->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $character->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="help is-info">Type a name and press Enter to create a new character.</p>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Suggested Stories</label>
                        <div class="control">
                            <select id="suggestedStories" multiple name="suggested_stories[]">
                                @foreach($allStories as $story)
                                    {{-- Don't show current story in list --}}
                                    @if($story->id != $shortStory->id)
                                        <option value="{{ $story->id }}" 
                                            {{ in_array($story->id, $shortStory->suggestedStories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $story->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Short Story Details</label>
                        <div class="control">
                            <textarea class="textarea editor2" placeholder="Enter Text" name="short_story_details">{{old('short_story_details', $shortStory->short_story_details)}}</textarea>
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
                                        <input type="radio" name="status" value="1" {{ old('status', $shortStory->status) == 1 ? 'checked' : '' }}>
                                        <span class="check"></span>
                                        <span class="control-label">Publish</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="status" value="0" {{ old('status', $shortStory->status) == 0 ? 'checked' : '' }}>
                                        <span class="check"></span>
                                        <span class="control-label">Draft</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field grouped" style="display: flex; gap: 15px; padding: 20px 0;">
                        <div class="control">
                            <button type="submit" 
                                    class="button" 
                                    style="background-color: #0056b3 !important; color: white !important; border: 1px solid #0056b3;">
                                Update & Next (Images) <i class="mdi mdi-arrow-right"></i>
                            </button>
                        </div>

                        <div class="control">
                            <button type="submit" 
                                    name="action" 
                                    value="save_and_exit" 
                                    class="button" 
                                    style="background-color: #17a2b8 !important; color: white !important; border: 1px solid #17a2b8;">
                                <i class="mdi mdi-check"></i> Update & Finish
                            </button>
                        </div>

                        <div class="control">
                            <a href="{{ route('admin.shortStories') }}" 
                               class="button" 
                               style="background-color: #dc3545 !important; color: white !important; border: 1px solid #dc3545; text-decoration: none;">
                                Reset
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Tags
        new Choices('#tags', { removeItemButton: true, searchEnabled: true });
        
        // 2. Categories
        new Choices('#categories', { removeItemButton: true, searchEnabled: true });
        
        // 3. Suggested Stories
        new Choices('#suggestedStories', { 
            removeItemButton: true, 
            searchEnabled: true,
            placeholderValue: 'Search for a story...',
            itemSelectText: ''
        });
        
        // --- FIX: CHARACTERS (Robust "Type to Create" Logic) ---
        const charSelect = document.getElementById('characters');
        const charChoices = new Choices(charSelect, { 
            removeItemButton: true, 
            searchEnabled: true,
            addItems: true,          // Allow adding new items
            userInput: true,         // Enable user input
            duplicateItemsAllowed: false,
            placeholderValue: 'Select or Type Name',
            // Custom text to tell user what to do
            noResultsText: 'Press Enter to add this character',
            // This function validates the input (accepts everything not empty)
            addItemFilter: function(value) {
                return !!value && value !== '';
            }
        });

        // --- KEY FIX: Prevent "Enter" from submitting the form while typing a character ---
        charSelect.addEventListener('showDropdown', function() {
            const searchInput = charChoices.input.element;
            searchInput.addEventListener('keydown', function(event) {
                // If "Enter" is pressed, stop the form from submitting
                if (event.key === 'Enter') {
                    event.preventDefault(); // Stop form submit
                    event.stopPropagation(); // Stop event bubbling
                    
                    // Manually trigger the "add" logic if Choices doesn't catch it
                    const value = searchInput.value;
                    if (value) {
                        charChoices.setValue([value]); // Add the typed value as a selection
                        charChoices.clearInput();      // Clear the search bar
                        charChoices.hideDropdown();    // Close dropdown
                    }
                }
            });
        });
        
        // CKEditor Config (Keep existing)
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
            language: 'en'
        };

        ClassicEditor.create(document.querySelector('.editor'), editorConfig).catch(error => { console.error(error); });
        ClassicEditor.create(document.querySelector('.editor2'), editorConfig).catch(error => { console.error(error); });
    });
</script>

<script>
    const thumbnailInput = document.getElementById('thumbnailPhoto');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    
    if(thumbnailInput) {
        thumbnailInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewBox = document.getElementById('thumbnailPreview');
            const errorText = document.getElementById('thumbnailError');
            
            // Clear previous
            previewBox.innerHTML = '';
            errorText.classList.add('hidden');

            if (file) {
                // Update file name display for Bulma file input
                if(fileNameDisplay) fileNameDisplay.textContent = file.name;

                if (file.size > 2 * 1024 * 1024) {
                    errorText.textContent = "File is too large (Max 2MB)";
                    errorText.classList.remove('hidden');
                    this.value = '';
                    fileNameDisplay.textContent = "No file selected";
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
</script>
@endsection