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
                    Enter Blog Details
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('admin.addBlogs.add') }}" enctype="multipart/form-data">
                    @csrf
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
                    {{-- <div class="field">
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
                    </div> --}}
                    
                    {{-- <div class="field">
                        <label class="label">Short description</label>
                        <div class="control">
                            <textarea class="textarea" placeholder="Enter Text" name="introducing">{{old('introducing')}}</textarea>
                        </div>
                        @error('introducing')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        
                    </div> --}}

                    <!-- Thumbnail Photo -->
                    <div class="form-group">
                        <label for="thumbnailPhoto" class="label">
                            Upload Thumbnail Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <input id="thumbnailPhoto" name="thumbnail_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-input"  />
                        <div id="thumbnailPreview" class="preview-box"></div>
                        <p id="thumbnailError" class="error-text hidden"></p>
                    </div>

                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label"> Tags </label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tags" multiple name="tags[]">
                                            @foreach ($tags as $tag)
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
                                <label class="label">Category Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="categories" multiple name="categories[]">
                                            @foreach ($categories as $category)
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
                                <label class="label">Article Type </label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="blogTypes" multiple name="blogTypes[]">
                                            @foreach ($blogTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('blogTypes')
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
                                <label class="label">Suggested Articles</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="suggestedArticles" multiple name="suggestedArticles[]">
                                            @foreach ($suggestedBlogs as $blog)
                                                <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('suggestedArticles')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Blog Details</label>
                        <div class="control">
                        <textarea class="textarea editor" placeholder="Enter Text" name="blog_details">{{old('blog_details')}}</textarea>
                        </div>
                        @error('blog_details')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="field">
                        <label class="label">More Information</label>
                        <div class="control">
                        <textarea class="textarea" placeholder="Enter Text" name="more_information">{{old('more_information')}}</textarea>
                        </div>
                        @error('more_information')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    
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
                    {{-- <div class="field">
                        <label for="featured_image"
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <p class="text-gray-500">Click to upload or drag & drop</p>
                            <p class="text-xs text-gray-400">PNG, JPG up to 2MB</p>
                            <input id="featured_image" name="featured_image" type="file" class="hidden" accept="image/*" />
                        </label>

                        <div id="preview" class="mt-4 hidden">
                            <img class="rounded-lg shadow w-full" />
                        </div>

                    </div> --}}
                    
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
            new Choices('#tags', { removeItemButton: true, searchEnabled: true });
            new Choices('#categories', { removeItemButton: true, searchEnabled: true });
            new Choices('#suggestedArticles', { removeItemButton: true, searchEnabled: true });
            new Choices('#blogTypes', { removeItemButton: true, searchEnabled: true });

            ClassicEditor
            .create(document.querySelector('.editor'))
            .catch(error => {
                console.error(error);
            });
        });
    </script>

@endsection
