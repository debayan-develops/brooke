@extends('layouts.admin')

@section('title', $title)

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    /* --- Filter Section Styling --- */
    .filter-section {
        background: #f9fafb;
        padding: 20px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin: 0 20px 20px 20px;
        display: flex;
        gap: 20px;
        align-items: flex-end;
    }
    .filter-group { flex: 1; }
    .filter-group label { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 5px; color: #374151; }
    .filter-input { width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; }
    .filter-actions { display: flex; gap: 10px; }
    
    /* Image Thumb */
    .thumb-img { width: 60px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid #eee; }
    
    /* Description limit */
    .desc-cell { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* --- BUTTON ALIGNMENT FIXES --- */
    .action-buttons { 
        display: flex; 
        gap: 5px; 
        justify-content: flex-end; 
        align-items: center; 
    }
    
    /* CRITICAL FIX: Make the delete form sit inline perfectly */
    .action-buttons form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    /* Force all buttons (links and submit buttons) to have exact same dimensions */
    .action-buttons .button {
        height: 32px;              /* Fixed height */
        padding: 0 12px;           
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        font-size: 0.875rem;
        border: 1px solid transparent; /* Ensure borders don't change size */
        vertical-align: middle;
    }
    
    .action-buttons .button .icon {
        display: flex;
        align-items: center;
        margin-right: 4px;
    }
    
    /* Icon-only buttons (Edit/Delete) need less padding to be square-ish */
    .action-buttons .button.small:not(:has(span:not(.icon))) {
        padding: 0 8px;
    }
    
    /* --- DATATABLES CLEANUP --- */
    .dataTables_filter { display: none !important; }
    .dataTables_wrapper { padding: 0 20px 20px 20px; }
    table.dataTable.no-footer { border-bottom: 1px solid #dbdbdb; }
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
                <h1 class="title">{{$title}}</h1>
                <a href="{{ route('admin.addNovels') }}" class="button green">Add Novel</a>
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

            <div class="filter-section">
                <div class="filter-group">
                    <label>Search Title</label>
                    <input type="text" id="filterTitle" class="filter-input" placeholder="Type Novel Title...">
                </div>
                <div class="filter-actions">
                    <button type="button" id="btnReset" class="button red">Reset</button>
                </div>
            </div>

            <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-book-open-page-variant"></i></span>
                        List
                    </p>
                    <a href="#" onclick="window.location.reload()" class="card-header-icon">
                        <span class="icon"><i class="mdi mdi-reload"></i></span>
                    </a>
                </header>
                
                <div class="card-content">
                    <table id="novelsTable" class="table is-fullwidth is-striped is-hoverable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Chapters</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="novelsTableBody">
                            @forelse($novels as $novel)
                            <tr>
                                <td>{{ $novel->id }}</td>
                                <td>
                                    @if($novel->thumbnail)
                                        <img src="{{ asset(config('app.assets_path') . $novel->thumbnail) }}" class="thumb-img" alt="Cover">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td style="font-weight: 600;">{{ $novel->title }}</td>
                                <td class="desc-cell" title="{{ strip_tags($novel->description) }}">
                                    {{ Str::limit(strip_tags($novel->description), 50) }}
                                </td>
                                <td>
                                    <span class="tag is-info is-light">
                                        {{ $novel->chapters ? $novel->chapters->count() : 0 }} Chapters
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.addChapter', $novel->id) }}" class="button small blue" title="Add Chapters">
                                            <span class="icon"><i class="mdi mdi-plus"></i></span>
                                            <span>Add Chapters</span>
                                        </a>

                                        <a href="{{ route('admin.editNovels', $novel->id) }}" class="button small blue" title="Edit">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>

                                        <form action="{{ route('admin.novels.delete', $novel->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this novel?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button small red" title="Delete">
                                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // 1. Initialize DataTable
            var table = $('#novelsTable').DataTable({
                "paging": true,
                "lengthChange": true, 
                "searching": true,    
                "ordering": true,
                "info": true,
                "pageLength": 10,
                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                "language": {
                    "lengthMenu": "Show _MENU_ entries"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [1, 5] } 
                ]
            });

            // 2. Connect Your Custom Search Bar
            $('#filterTitle').on('keyup', function() {
                table.search(this.value).draw();
            });

            // 3. Reset Button
            $('#btnReset').on('click', function() {
                $('#filterTitle').val(''); 
                table.search('').draw(); 
            });
        });
    </script>
@endsection