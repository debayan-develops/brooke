@extends('layouts.admin')

@section('title', 'Edit Novel')

<style>
    /* Styling to match Add Chapter page */
    .ck-editor__editable_inline { min-height: 400px; }
    .thumb {
        position: relative;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        height: 100px;
        display: grid;
        place-items: center;
    }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }
    
    /* --- BUTTON ALIGNMENT FIXES (Consistent with Add Chapter) --- */
    .action-buttons { 
        display: flex; 
        gap: 5px; 
        justify-content: flex-end; 
        align-items: center; 
    }
    
    /* Ensure form sits inline */
    .action-buttons form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    /* Force button uniformity */
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
                    <li>Novels</li>
                    <li>Edit Novel</li>
                </ul>
            </div>
        </section>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">Edit Novel: {{ $novel->title }}</h1>
                <a href="{{ route('admin.novels') }}" class="button blue">Go Back</a>
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
                        <span class="icon"><i class="mdi mdi-pencil"></i></span>
                        Novel Details
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.novels.update', $novel->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="field">
                            <label class="label">Title</label>
                            <div class="control">
                                <input class="input" type="text" name="title" value="{{ old('title', $novel->title) }}" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Author</label>
                            <div class="control">
                                <input class="input" type="text" name="author" value="{{ old('author', $novel->author) }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea description" name="description">{{ old('description', $novel->description) }}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Current Thumbnail</label>
                            @if($novel->thumbnail)
                                <div class="thumb" style="width: 150px; margin-bottom: 10px;">
                                    <img src="{{ asset('storage/' . $novel->thumbnail) }}">
                                </div>
                            @endif
                            <label class="label">Change Thumbnail</label>
                            <div class="control">
                                <input class="input" type="file" name="thumbnail">
                            </div>
                        </div>

                        <div class="field" style="margin-top: 20px">
                            <label class="label">Status</label>
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="status" value="1" {{ $novel->status == 1 ? 'checked' : '' }}>
                                    Active
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" value="0" {{ $novel->status == 0 ? 'checked' : '' }}>
                                    Inactive
                                </label>
                            </div>
                        </div>

                        <div class="field grouped" style="margin-top: 20px">
                            <div class="control">
                                <button type="submit" class="button green">Update Novel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-book-open-page-variant"></i></span>
                        Existing Chapters
                    </p>
                    <a href="{{ route('admin.addChapter', $novel->id) }}" class="button small blue" style="margin: 10px;">
                        <span class="icon"><i class="mdi mdi-plus"></i></span>
                        <span>Add New Chapter</span>
                    </a>
                </header>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped">
                        <thead>
                            <tr>
                                <th>Chapter No.</th>
                                <th>Chapter Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($novel->chapters as $chapter)
                            <tr>
                                <td>{{ $chapter->chapter_number }}</td>
                                <td>{{ $chapter->title }}</td>
                                <td>
                                    <div class="action-buttons">
                                        
                                        <a href="{{ route('admin.novels.editChapter', ['novel_id' => $novel->id, 'chapter_id' => $chapter->id]) }}" class="button small blue" title="Edit Chapter">
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
                                <td colspan="3" style="text-align: center; color: gray; padding: 20px;">No chapters found.</td>
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
            ClassicEditor
                .create(document.querySelector('.textarea.description'))
                .catch(error => { console.error(error); });
        });
    </script>
@endsection