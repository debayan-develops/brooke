@extends('layouts.admin')

@section('title', $title)



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
                <h1 class="title">
                {{$title}}
                </h1>
                {{-- <button class="button light">Button</button> --}}
            </div>
        </section>

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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
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
                    <td data-label="Name">John Doe</td>
                    <td data-label="Company">johndoe@gmail.com</td>
                    <td data-label="Company">+13216549870</td>
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
                                <span class="icon"><i class="mdi mdi-eye"></i></span>
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
                    <td data-label="Name">2</td>
                    <td data-label="Name">John Doe</td>
                    <td data-label="Company">johndoe@gmail.com</td>
                    <td data-label="Company">+13216549870</td>
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
                                <span class="icon"><i class="mdi mdi-eye"></i></span>
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
                    <td data-label="Name">John Doe</td>
                    <td data-label="Company">johndoe@gmail.com</td>
                    <td data-label="Company">+13216549870</td>
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
                            <span class="icon"><i class="mdi mdi-eye"></i></span>
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
                    <td data-label="Name">John Doe</td>
                    <td data-label="Company">johndoe@gmail.com</td>
                    <td data-label="Company">+13216549870</td>
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
                                <span class="icon"><i class="mdi mdi-eye"></i></span>
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
                    <td data-label="Name">5</td>
                    <td data-label="Name">John Doe</td>
                    <td data-label="Company">johndoe@gmail.com</td>
                    <td data-label="Company">+13216549870</td>
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
                            <span class="icon"><i class="mdi mdi-eye"></i></span>
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

        {{-- <section class="section main-section">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
            <div class="card">
                <div class="card-content">
                <div class="flex items-center justify-between">
                    <div class="widget-label">
                    <h3>
                        Clients
                    </h3>
                    <h1>
                        512
                    </h1>
                    </div>
                    <span class="icon widget-icon text-green-500"><i class="mdi mdi-account-multiple mdi-48px"></i></span>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                <div class="flex items-center justify-between">
                    <div class="widget-label">
                    <h3>
                        Sales
                    </h3>
                    <h1>
                        $7,770
                    </h1>
                    </div>
                    <span class="icon widget-icon text-blue-500"><i class="mdi mdi-cart-outline mdi-48px"></i></span>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                <div class="flex items-center justify-between">
                    <div class="widget-label">
                    <h3>
                        Performance
                    </h3>
                    <h1>
                        256%
                    </h1>
                    </div>
                    <span class="icon widget-icon text-red-500"><i class="mdi mdi-finance mdi-48px"></i></span>
                </div>
                </div>
            </div>
            </div>

            
        </section> --}}

        
        
    </div>
@endsection
