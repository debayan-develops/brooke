@extends('layouts.admin')

@section('title', $title ?? 'Admin Panel')

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    /* Custom styles for Choices.js */
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

        <!-- Hero Bar -->
        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                {{$title}}
                </h1>
                <button type="button" data-target="add-features-modal" class="button blue --jb-modal">Add Tags</button>
            </div>
        </section>

        <div id="add-features-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form method="POST" action="">
                @csrf
                <header class="modal-card-head">
                    <p class="modal-card-title">Add New Tags</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Tag Name</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="text" placeholder="Name" name="name">
                                    <span class="icon left"><i class="mdi mdi-pin"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Tag Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tagsType" multiple name="tagsType[]">
                                            {{-- @foreach($facilities as $facility)
                                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                            @endforeach --}}
                                            <option value="1">Novel</option>
                                            <option value="2">Blog</option>
                                            <option value="3">Short Story</option>
                                        </select>
                                        @error('home_nearby_facilities_id')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>
    <button id="modalShowBtn" class="--jb-modal" data-target=""></button>

    {{-- Edit Feature Modal --}}
    <div id="edit-features-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form method="POST" action="">
                @csrf
                <input type="hidden" name="id" value="">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Tags</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="text" placeholder="Name" name="name">
                                    <span class="icon left"><i class="mdi mdi-pin"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>


        <section class="section main-section">
            <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                List
                </p>
                <a href="#" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>
            <div class="card-content">
                <table>
                <thead>
                <tr>
                    {{-- <th class="checkbox-cell">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                    </th> --}}
                    {{-- <th class="image-cell"></th> --}}
                    <th>#</th>
                    <th>Tags Name</th>
                    <th>Tags Type</th>
                    {{-- <th>City</th>
                    <th>Progress</th>
                    <th>Created</th> --}}
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    {{-- <td class="checkbox-cell">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                    </td>
                    <td class="image-cell">
                    <div class="image">
                        <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="rounded-full">
                    </div>
                    </td> --}}
                    <td data-label="Name">1</td>
                    <td data-label="Name">Tag 1</td>
                    <td data-label="Company">Novels</td>
                    {{-- <td data-label="City">South Cory</td>
                    <td data-label="Progress" class="progress-cell">
                    <progress max="100" value="79">79</progress>
                    </td>
                    <td data-label="Created">
                    <small class="text-gray-500" title="Oct 25, 2021">Oct 25, 2021</small>
                    </td> --}}
                    <td class="actions-cell">
                    <div class="buttons right nowrap">
                        {{-- <button class="button small blue --jb-modal"  data-target="sample-modal-2" type="button">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        </button> --}}
                        <button type="button" data-target="edit-features-modal" class="button small blue --jb-modal"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></button>
                        <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    </div>
                    </td>
                </tr>
                <tr>
                    {{-- <td class="checkbox-cell">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                    </td>
                    <td class="image-cell">
                    <div class="image">
                        <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="rounded-full">
                    </div>
                    </td> --}}
                    <td data-label="Name">2</td>
                    <td data-label="Name">Tag 2</td>
                    <td data-label="Company">Novels</td>
                    {{-- <td data-label="City">South Cory</td>
                    <td data-label="Progress" class="progress-cell">
                    <progress max="100" value="79">79</progress>
                    </td>
                    <td data-label="Created">
                    <small class="text-gray-500" title="Oct 25, 2021">Oct 25, 2021</small>
                    </td> --}}
                    <td class="actions-cell">
                    <div class="buttons right nowrap">
                        <button class=" button small blue --jb-modal" data-id="" type="button">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        </button>
                        <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    </div>
                    </td>
                </tr>
                <tr>
                    {{-- <td class="checkbox-cell">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                    </td>
                    <td class="image-cell">
                    <div class="image">
                        <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="rounded-full">
                    </div>
                    </td> --}}
                    <td data-label="Name">3</td>
                    <td data-label="Name">Tag 3</td>
                    <td data-label="Company">Short Stories</td>
                    {{-- <td data-label="City">South Cory</td>
                    <td data-label="Progress" class="progress-cell">
                    <progress max="100" value="79">79</progress>
                    </td>
                    <td data-label="Created">
                    <small class="text-gray-500" title="Oct 25, 2021">Oct 25, 2021</small>
                    </td> --}}
                    <td class="actions-cell">
                    <div class="buttons right nowrap">
                        <button class="button small blue --jb-modal"  data-target="sample-modal-2" type="button">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        </button>
                        <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    </div>
                    </td>
                </tr>
                <tr>
                    {{-- <td class="checkbox-cell">
                    <label class="checkbox">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                    </td>
                    <td class="image-cell">
                    <div class="image">
                        <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="rounded-full">
                    </div>
                    </td> --}}
                    <td data-label="Name">4</td>
                    <td data-label="Name">Tag 4</td>
                    <td data-label="Company">Blog</td>
                    {{-- <td data-label="City">South Cory</td>
                    <td data-label="Progress" class="progress-cell">
                    <progress max="100" value="79">79</progress>
                    </td>
                    <td data-label="Created">
                    <small class="text-gray-500" title="Oct 25, 2021">Oct 25, 2021</small>
                    </td> --}}
                    <td class="actions-cell">
                    <div class="buttons right nowrap">
                        <button class="button small blue --jb-modal"  data-target="sample-modal-2" type="button">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        </button>
                        <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    </div>
                    </td>
                </tr>
                
                </tbody>
                </table>
                <div class="table-pagination">
                <div class="flex items-center justify-between">
                    <div class="buttons">
                    <button type="button" class="button active">1</button>
                    <button type="button" class="button">2</button>
                    <button type="button" class="button">3</button>
                    </div>
                    <small>Page 1 of 3</small>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Choices('#tagsType', { removeItemButton: true, searchEnabled: true });
        });

    </script>
@endsection