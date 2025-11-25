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

    .ck-editor__editable_inline {
    min-height: 400px;
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
                    Enter Novel Details
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('admin.addChapter') }}">
                    @csrf
                    <input type="hidden" name="home_id" value="">
                    <div class="field" style="margin-top: 20px">
                        <label class="label">Content View Permission</label>
                        <div class="field-body">
                            <div class="field grouped multiline">
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="is_active" value="1" checked>
                                    <span class="check"></span>
                                    <span class="control-label">Public</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="is_active" value="0">
                                    <span class="check"></span>
                                    <span class="control-label">Registered User</span>
                                    </label>
                                </div>
                                <div class="control">
                                    <label class="radio">
                                    <input type="radio" name="is_active" value="0">
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
                        <input id="thumbnailPhoto" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-input"  />
                        <div id="thumbnailPreview" class="preview-box"></div>
                        <p id="thumbnailError" class="error-text hidden"></p>
                    </div>

                    <!-- Banner Photo -->
                    <div class="form-group">
                        <label for="bannerPhoto" class="label">
                            Upload Banner Photo <span class="form-hint">(JPG, PNG, WEBP • Max 2MB)</span>
                        </label>
                        <input id="bannerPhoto" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-input"  />
                        <div id="bannerPreview" class="preview-box"></div>
                        <p id="bannerError" class="error-text hidden"></p>
                    </div>

                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label"> Tags</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tagType" multiple name="tagType[]">
                                            {{-- @foreach($facilities as $facility)
                                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                            @endforeach --}}
                                            <option value="1">Tag 1</option>
                                            <option value="2">Tag 2</option>
                                            <option value="3">Tag 3</option>
                                            <option value="4">Tag 4</option>
                                            <option value="5">Tag 5</option>
                                            <option value="6">Tag 6</option>
                                        </select>
                                        @error('home_nearby_facilities_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Category Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="categoryType" multiple name="categoryType[]">
                                            
                                            <option value="1">Category 1</option>
                                            <option value="2">Category 2</option>
                                            <option value="3">Category 3</option>
                                            <option value="4">Category 4</option>
                                            <option value="5">Category 5</option>
                                            <option value="6">Category 6</option>
                                        </select>
                                        @error('home_nearby_facilities_id')
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
                                <label class="label">Article Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="characters" multiple name="characters[]">
                                            
                                            <option value="1">Novel</option>
                                            <option value="2">Journal</option>
                                            <option value="3">Type 3</option>
                                            <option value="4">Type 4</option>
                                            <option value="5">Type 5</option>
                                            <option value="6">Type 6</option>
                                        </select>
                                        @error('home_nearby_facilities_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Suggested Novels</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="suggestedNovels" multiple name="suggestedNovels[]">
                                            {{-- @foreach($facilities as $facility)
                                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                            @endforeach --}}
                                            <option value="1">Suggested Novels 1</option>
                                            <option value="2">Suggested Novels 2</option>
                                            <option value="3">Suggested Novels 3</option>
                                            <option value="4">Suggested Novels 4</option>
                                            <option value="5">Suggested Novels 5</option>
                                            <option value="6">Suggested Novels 6</option>
                                        </select>
                                        @error('home_nearby_facilities_id')
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
                        <textarea class="textarea introducing" placeholder="Enter Text" name="introducing" row="4">{{old('introducing')}}</textarea>
                        </div>
                        @error('introducing')
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
            new Choices('#tagType', { removeItemButton: true, searchEnabled: true });
            new Choices('#suggestedNovels', { removeItemButton: true, searchEnabled: true });
            ClassicEditor
                .create( document.querySelector( '.textarea.introducing' ) )
                .catch( error => {
                    console.error( error );
                } );
        });

    </script>

@endsection
