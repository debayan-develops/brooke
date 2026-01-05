@extends('layouts.admin')

@section('title', 'Edit Novel')

<style>
    /* CKEditor Bullets/Numbering Fix & Height */
    .ck-content ol, .ck-content ul { margin-left: 20px !important; padding-left: 20px !important; }
    .ck-content ol { list-style-type: decimal !important; }
    .ck-content ul { list-style-type: disc !important; }
    .ck-content li { margin-bottom: 5px; }
    .ck-editor__editable_inline { min-height: 400px !important; }

    /* Custom Radio Buttons (Active/Inactive/Permission) */
    .custom-radio { display: inline-flex !important; align-items: center !important; cursor: pointer !important; position: relative !important; margin-right: 20px; }
    .custom-radio input[type="radio"] { position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; }
    .radio-circle { height: 20px !important; width: 20px !important; background-color: #fff !important; border: 2px solid #ccc !important; border-radius: 50% !important; display: inline-block !important; position: relative !important; transition: all 0.2s ease-in-out; }
    .custom-radio input:checked ~ .radio-circle { background-color: #2563eb !important; border-color: #2563eb !important; }
    .radio-circle::after { content: ""; position: absolute; display: none; top: 5px; left: 5px; width: 6px; height: 6px; border-radius: 50%; background: white; }
    .custom-radio input:checked ~ .radio-circle::after { display: block !important; }
    .radio-text { margin-left: 8px !important; font-weight: 500 !important; color: #333 !important; }

    /* Thumbnails */
    .thumb { position: relative; border: 1px solid #d1d5db; border-radius: 10px; overflow: hidden; background: #fff; display: grid; place-items: center; }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }
    
    /* Button Alignment for Table */
    .action-buttons { display: flex; gap: 5px; justify-content: flex-end; align-items: center; }
    .action-buttons form { display: inline-flex; margin: 0; padding: 0; }
    .action-buttons .button { height: 32px; padding: 0 12px; display: inline-flex; align-items: center; justify-content: center; white-space: nowrap; font-size: 0.875rem; border: 1px solid transparent; vertical-align: middle; }
    .action-buttons .button .icon { display: flex; align-items: center; margin-right: 4px; }
    .action-buttons .button.small:not(:has(span:not(.icon))) { padding: 0 8px; }
</style>

<style>@import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');</style>

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
                        
                        <div class="field" style="margin-top: 20px">
                            <label class="label">Content View Permission</label>
                            <div class="control" style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                                <label class="custom-radio">
                                    <input type="radio" name="permission" value="1" {{ $novel->permission == 1 ? 'checked' : '' }}>
                                    <span class="radio-circle"></span> <span class="radio-text">Public</span>
                                </label>
                                <label class="custom-radio">
                                    <input type="radio" name="permission" value="0" {{ $novel->permission == 0 ? 'checked' : '' }}>
                                    <span class="radio-circle"></span> <span class="radio-text">Registered User</span>
                                </label>
                                <label class="custom-radio">
                                    <input type="radio" name="permission" value="2" {{ $novel->permission == 2 ? 'checked' : '' }}>
                                    <span class="radio-circle"></span> <span class="radio-text">Paid User</span>
                                </label>
                            </div>
                        </div>

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
                            <label class="label">Current Thumbnail</label>
                            @if($novel->thumbnail)
                                <div class="thumb" style="width: 150px; margin-bottom: 10px;">
                                    <img src="{{ asset(config('app.assets_path') . $novel->thumbnail) }}">
                                </div>
                            @endif
                            <label class="label">Change Thumbnail</label>
                            <div class="control">
                                <input class="input" type="file" name="thumbnail">
                            </div>
                        </div>

                        <div class="field" style="margin-top: 20px;">
                            <label class="label">Current Banner</label>
                            @if($novel->banner_image)
                                <div class="thumb" style="width: 300px; height: 120px; margin-bottom: 10px;">
                                    <img src="{{ asset('storage/' . $novel->banner_image) }}" 
                                         alt="Banner Image"
                                         style="object-fit: cover; width: 100%; height: 100%;"
                                         onerror="this.style.display='none'">
                                </div>
                            @else
                                <p class="text-gray-500 text-sm mb-2">No banner uploaded.</p>
                            @endif
                            <label class="label">Change Banner</label>
                            <div class="control">
                                <input class="input" type="file" name="banner_image">
                            </div>
                        </div>

                        <div class="field" style="margin-top: 20px;">
                            <label class="label">Tags</label>
                            <div class="control">
                                <select id="tagType" multiple name="tags[]">
                                    @if(isset($tags) && count($tags) > 0)
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" 
                                                @if(isset($novel->tags) && $novel->tags->contains($tag->id)) selected @endif>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Related Novels</label>
                            <div class="control">
                                <select id="relatedNovels" multiple name="relatedNovels[]">
                                    @if(isset($relatedNovels) && count($relatedNovels) > 0)
                                        @foreach($relatedNovels as $relNovel)
                                            <option value="{{ $relNovel->id }}"
                                                @if(isset($novel->relatedNovels) && $novel->relatedNovels->contains($relNovel->id)) selected @endif>
                                                {{ $relNovel->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Short Description</label>
                            <div class="control">
                                <textarea class="textarea description" name="description">{{ old('description', $novel->description) }}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">About Story</label>
                            <div class="control">
                                <textarea class="textarea about_story" name="about_story">{{ old('about_story', $novel->about_story) }}</textarea>
                            </div>
                        </div>

                        <div class="field" style="margin-top: 20px;">
                            <label class="label">Status</label>
                            <div class="control" style="display: flex; gap: 20px; align-items: center;">
                                <label class="custom-radio">
                                    <input type="radio" name="status" value="1" {{ $novel->status == 1 ? 'checked' : '' }}>
                                    <span class="radio-circle"></span> <span class="radio-text">Active</span>
                                </label>
                                <label class="custom-radio">
                                    <input type="radio" name="status" value="0" {{ $novel->status == 0 ? 'checked' : '' }}>
                                    <span class="radio-circle"></span> <span class="radio-text">Inactive</span>
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
                                <th style="text-align: right;">Actions</th>
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

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices.js
            new Choices('#tagType', { removeItemButton: true, searchEnabled: true });
            new Choices('#relatedNovels', { removeItemButton: true, searchEnabled: true });

            // Initialize CKEditor for Short Description
            ClassicEditor
                .create(document.querySelector('.textarea.description'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => { console.error(error); });

            // Initialize CKEditor for About Story
            ClassicEditor
                .create(document.querySelector('.textarea.about_story'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => { console.error(error); });
        });
    </script>
@endsection