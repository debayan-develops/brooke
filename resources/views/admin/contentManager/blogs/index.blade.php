@extends('layouts.admin')

@section('title', $title)

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom DataTables Styling */
    .dataTables_wrapper { padding: 20px; }
    .dataTables_wrapper .dataTables_length select { padding-right: 30px; border-radius: 4px; border: 1px solid #ddd; }
    .dataTables_wrapper .dataTables_filter input { border-radius: 4px; border: 1px solid #ddd; padding: 5px; margin-left: 5px; }
    
    /* Table Styling */
    table.dataTable { border-collapse: collapse !important; width: 100% !important; margin-top: 10px !important; }
    table.dataTable th, table.dataTable td { padding: 12px 10px; border-bottom: 1px solid #eee; }
    table.dataTable thead th { background-color: #f9fafb; font-weight: 600; text-align: left; vertical-align: middle; }
    
    /* Pagination */
    .dataTables_paginate .paginate_button { padding: 5px 10px !important; border-radius: 4px !important; }
    .dataTables_paginate .paginate_button.current { background: #3b82f6 !important; color: white !important; border: none !important; }

    /* Image Thumb */
    .thumb-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
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
                    <li>{{$title}}</li>
                </ul>
            </div>
        </section>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                {{$title}}
                </h1>
                <a href="{{ route('admin.addBlogs') }}" class="button green">Add Blog</a>
            </div>
        </section>

        <section class="section main-section">
            <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                    Blog List
                </p>
                <a href="#" onclick="window.location.reload()" class="card-header-icon">
                    <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>
            <div class="card-content">
                <table id="blogTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td data-label="ID">{{ $blog->id }}</td>
                        <td data-label="Image">
                            {{-- FIX: Using storage path --}}
                            @if($blog->thumbnail_photo)
                                <img src="{{ asset('storage/' . $blog->thumbnail_photo) }}" alt="Thumbnail" class="thumb-img" />
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td data-label="Title" style="font-weight: 600;">{{ $blog->title }}</td>
                        <td data-label="Created">
                            <small class="text-gray-500">{{ $blog->created_at ? $blog->created_at->format('M d, Y') : '-' }}</small>
                        </td>
                        <td class="actions-cell">
                            <div class="buttons right nowrap">
                                <a href="{{ route('admin.editBlogs', $blog->id) }}" class="button small blue edit-btn">
                                    <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                </a>
                                {{-- Add Delete button here if route exists --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#blogTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                "pageLength": 10,
                "order": [[ 0, "desc" ]], // Order by ID descending (newest first)
                "columnDefs": [
                    { "orderable": false, "targets": [1, 4] } // Disable sorting on Image and Actions
                ]
            });
        });
    </script>
@endsection