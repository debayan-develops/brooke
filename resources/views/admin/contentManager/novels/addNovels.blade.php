@extends('layouts.admin')

@section('title', $title)



@section('content')
<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    /* Override default Choices.js styles */
    .textarea.introducing {
        height: 15rem;
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
                    Enter Home Details
                </p>
            </header>
            <div class="card-content">
                <form method="POST" action="{{ route('admin.addNovels') }}">
                    @csrf
                    <input type="hidden" name="home_id" value="">
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" placeholder="Name" name="title" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contact Email</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" placeholder="Contact Email" name="contact_email" value="{{ old('contact_email') }}">
                                </div>
                                @error('contact_email')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            <div class="field">
                                <label class="label">Location</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Location" name="location" value="{{ old('location') }}">
                                </div>
                                @error('location')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label class="label">City</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="City" name="city" value="{{ old('city') }}">
                                </div>
                                @error('city')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            <div class="field">
                                <label class="label">Country</label>
                                <div class="control">
                                    {{-- <div class="select">
                                        <select id="country-select" name="country_id">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">State</label>
                                <div class="control">
                                    <div class="select">
                                        <select id="state-select" name="state_id">
                                            <!-- States will be populated based on selected country -->
                                        </select>
                                        @error('state_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="field">
                                <label class="label">Zip/Postal Code</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="Zip/Postal Code" name="post_code" value="{{ old('post_code') }}">
                                </div>
                                @error('post_code')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Available To</label>
                                <div class="control">
                                    <div class="select">
                                        {{-- <select id="available-select" name="available_to" class="">
                                            <option value="0">Anytime</option>
                                            @foreach ($months as $key => $item)
                                                <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                            
                                        </select> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            <div class="field">
                                <label class="label">Bedroom</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="bedrooms">
                                            <option value="">Select Bedrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        @error('bedrooms')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Bathroom</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="bathrooms">
                                            <option value="">Select Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        @error('bathrooms')
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
                                <label class="label">Features</label>
                                {{-- <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="Features-multiple" multiple name="home_features_id[]">
                                            @foreach($features as $feature)
                                                <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('home_features_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Nearby Facilities</label>
                                <div class="control icons-left icons-right">
                                    {{-- <div class="select">
                                        <select id="facilities-multiple" multiple name="home_nearby_facilities_id[]">
                                            @foreach($facilities as $facility)
                                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('home_nearby_facilities_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Introducing</label>
                        <div class="control">
                        <textarea class="textarea introducing" placeholder="Enter Text" name="introducing">{{old('introducing')}}</textarea>
                        </div>
                        @error('introducing')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="field">
                        <label class="label">Our Location</label>
                        <div class="control">
                        <textarea class="textarea" placeholder="Enter Text" name="our_location">{{old('our_location')}}</textarea>
                        </div>
                        @error('our_location')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">About Home</label>
                        <div class="control">
                            <textarea class="textarea" placeholder="Enter Text" name="about_home">{{old('about_home')}}</textarea>
                        </div>
                        @error('about_home')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">More Information</label>
                        <div class="control">
                        <textarea class="textarea" placeholder="Enter Text" name="more_information">{{old('more_information')}}</textarea>
                        </div>
                        @error('more_information')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Choices('#Features-multiple', { removeItemButton: true, searchEnabled: true });
            new Choices('#facilities-multiple', { removeItemButton: true, searchEnabled: true });
            new Choices('#country-select', { searchEnabled: true });
            new Choices('#available-select', { searchEnabled: true, shouldSort: false });
            const stateChoices = new Choices('#state-select', { searchEnabled: true });
            $('#country-select').on('change', function () {
                stateChoices.clearChoices();
                let countryId = $(this).val();
                stateChoices.setChoices([{ value: '', label: 'Loading...', selected: true }], 'value', 'label', false);


                $.get(`countries/${countryId}/states`, function (data) {
                    stateChoices.setChoices([{ value: '', label: 'Select State', selected: true }], 'value', 'label', false);
                    let stateOptions = data.map(state => ({
                        value: state.id,
                        label: state.name
                    }));
                    stateChoices.setChoices(stateOptions, 'value', 'label', true);
                });
            });
        });
    </script>

@endsection
