@extends('layouts.admin')

@section('title', $title)

<style>
    /* --- FIX: FORCE BULLETS & NUMBERS TO SHOW IN EDITOR --- */
    .ck-content ol, .ck-content ul {
        margin-left: 20px !important;
        padding-left: 20px !important;
    }
    .ck-content ol { list-style-type: decimal !important; }
    .ck-content ul { list-style-type: disc !important; }
    .ck-content li { margin-bottom: 5px; }

    /* Existing Styles */
    :root {
        --primary: #2563eb;
        --primary-dark: #1e4ed8;
        --border: #d1d5db;
        --bg: #f8fafc;
        --muted: #6b7280;
        --danger: #ef4444;
    }
    .ck-editor__editable_inline { min-height: 400px; }
    
    /* --- BUTTON ALIGNMENT FIXES (Same as Main List) --- */
    .action-buttons { 
        display: flex; 
        gap: 5px; 
        justify-content: flex-end; 
        align-items: center; 
    }
    
    .action-buttons form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    .action-buttons .button {
        height: 32px;
        padding: 0 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        font-size: 0.875rem;
        border: 1px solid transparent;
        vertical-align: middle;
    }
    
    .action-buttons .button .icon {
        display: flex;
        align-items: center;
        margin-right: 4px;
    }
    
    /* Icon-only buttons padding fix */
    .action-buttons .button.small:not(:has(span:not(.icon))) {
        padding: 0 8px;
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
                    <li>Novel</li>
                    <li>{{$title}}</li>
                </ul>
            </div>
        </section>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">{{$title}}</h1>
                <a href="{{ route('admin.editNovels', $novelId) }}" class="button blue">Go Back</a>
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

            <div class="card-content">
                @if(isset($chapterToEdit))
                    <form method="POST" id="chapterForm" action="{{ route('admin.novels.updateChapter', $chapterToEdit->id) }}">
                    @method('PUT')
                @else
                    <form method="POST" id="chapterForm" action="{{ route('admin.novels.storeChapter', ['novel_id' => $novelId]) }}">
                @endif
                    @csrf
                    
                    <div class="field">
                        <label class="label">Chapter Number</label>
                        <div class="control">
                            <input class="input" type="number" placeholder="Chapter Number" name="chapter_number" 
                                   value="{{ old('chapter_number', $chapterToEdit->chapter_number ?? '') }}">
                        </div>
                        @error('chapter_number')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">Chapter Title</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Chapter Title" name="title" 
                                   value="{{ old('title', $chapterToEdit->title ?? '') }}">
                        </div>
                        @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label">Chapter Description</label>
                        <div class="control">
                            <textarea class="textarea description" placeholder="Enter Text" name="description">{{ old('description', $chapterToEdit->description ?? '') }}</textarea>
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
                                        <input type="radio" name="is_active" value="1" 
                                        {{ (old('is_active', $chapterToEdit->is_active ?? 1) == 1) ? 'checked' : '' }}>
                                        <span class="check"></span>
                                        <span class="control-label">Active</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="is_active" value="0"
                                        {{ (old('is_active', $chapterToEdit->is_active ?? 1) == 0) ? 'checked' : '' }}>
                                        <span class="check"></span>
                                        <span class="control-label">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field grouped" style="margin-top: 20px">
                        <div class="control">
                            <button type="submit" class="button {{ isset($chapterToEdit) ? 'green' : 'blue' }}">
                                {{ isset($chapterToEdit) ? 'Update Chapter' : 'Add Chapter' }}
                            </button>
                        </div>
                        
                        @if(isset($chapterToEdit))
                        <div class="control">
                            <a href="{{ route('admin.addChapter', $novelId) }}" class="button red">
                                Cancel Edit
                            </a>
                        </div>
                        @else
                        <div class="control">
                            <button type="reset" id="resetBtn" class="button red">
                                Reset
                            </button>
                        </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="card has-table" style="margin-top: 30px;">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        Existing Chapters
                    </p>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped">
                        <thead>
                            <tr>
                                <th>Chapter No.</th>
                                <th>Chapter Title</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($chapters as $chapter)
                            <tr style="{{ (isset($chapterToEdit) && $chapterToEdit->id == $chapter->id) ? 'background-color: #e6fffa;' : '' }}">
                                <td>{{ $chapter->chapter_number }}</td>
                                <td>{{ $chapter->title }}</td>
                                <td>
                                    <div class="action-buttons">
                                        
                                        <a href="{{ route('admin.novels.editChapter', ['novel_id' => $novelId, 'chapter_id' => $chapter->id]) }}" class="button small blue" title="Edit Chapter">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>

                                        <a href="{{ route('admin.novels.addChapterSlider', $chapter->id) }}" class="button small blue" title="Add Slider Images">
                                            <span class="icon"><i class="mdi mdi-image-multiple"></i></span>
                                            <span class="is-hidden-mobile">Add Slider</span>
                                        </a>

                                        <form action="{{ route('admin.novels.deleteChapter', $chapter->id) }}" method="POST" onsubmit="return confirm('Delete this chapter?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button small red" title="Delete Chapter">
                                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: gray; padding: 20px;">No chapters added yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </section>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editorInstance; 

            // Initialize Editor
            ClassicEditor
                .create(document.querySelector('.textarea.description'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => { console.error(error); });

            // Reset Button Logic
            const resetBtn = document.getElementById('resetBtn');
            if(resetBtn){
                resetBtn.addEventListener('click', function () {
                    if (editorInstance) {
                        editorInstance.setData('');
                    }
                });
            }
        });
    </script>
@endsection