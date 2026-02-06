@extends('layouts.admin')

@section('title', $title)

<style>
    /* Filter Section Styling */
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

    /* New Link Styling */
    .title-link {
        color: #2563eb; /* Blue color */
        text-decoration: none;
        transition: color 0.2s;
    }
    .title-link:hover {
        color: #1e40af; /* Darker blue on hover */
        text-decoration: underline;
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
                <h1 class="title">{{$title}}</h1>
                <a href="{{ route('admin.addShortStories') }}" class="button green">Add Short Story</a>
            </div>
        </section>

        <section class="section main-section" style="padding-bottom: 0;">
            <div class="filter-section">
                <div class="filter-group">
                    <label>Search Title</label>
                    <input type="text" id="filterTitle" class="filter-input" placeholder="Type Story Title...">
                </div>
                <div class="filter-actions">
                    <button type="button" id="btnReset" class="button red">Reset</button>
                </div>
            </div>
        </section>

        <section class="section main-section">
            <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                        Short Story List
                    </p>
                    <a href="#" onclick="window.location.reload()" class="card-header-icon">
                        <span class="icon"><i class="mdi mdi-reload"></i></span>
                    </a>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="shortStoryTableBody">
                            </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
       
        document.addEventListener('DOMContentLoaded', function () {
           
            // 1. Data Preparation
            const allStories = @json($shortStories);
            const assetBase = "{{ asset(config('app.assets_path')) }}";
           
            // --- FIX START: URL GENERATION ---
            
            // 1. Frontend View URL (Relative Path to fix port issues)
            const viewBase = "/short-stories/";
            
            // 2. Admin Edit URL (Template Method)
            // We generate the route with a dummy ID '999999' using the 3rd argument 'false' for relative path
            const editUrlTemplate = "{{ route('admin.editShortStories', '999999') }}";

            // ---------------------

            // 2. Render Function
            function renderTable(data) {
                const tbody = document.getElementById('shortStoryTableBody');
                tbody.innerHTML = '';

                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center p-4">No records found</td></tr>';
                    return;
                }

                data.forEach(item => {
                    // Image Logic
                    let imgHtml = '<span class="text-gray-400">No Image</span>';
                    if (item.thumbnail_photo) {
                        imgHtml = `<img src="${assetBase}/${item.thumbnail_photo}" class="thumb-img">`;
                    }

                    // Date Logic
                    let dateStr = '-';
                    if (item.created_at) {
                        let d = new Date(item.created_at);
                        dateStr = d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                    }

                    // --- GENERATE LINKS ---
                    
                    // View Link: Simple Append
                    let finalViewUrl = viewBase + item.id;
                    
                    // Edit Link: Search and Replace '999999' with real ID
                    // This ensures '/edit' or other URL parts are preserved
                    let finalEditUrl = editUrlTemplate.replace('999999', item.id);

                    let row = `
                        <tr>
                            <td data-label="ID">${item.id}</td>
                            <td data-label="Image">${imgHtml}</td>
                            
                            <td data-label="Title" style="font-weight: 600;">
                                <a href="${finalViewUrl}" target="_blank" class="title-link">
                                    ${item.title} 
                                    <i class="mdi mdi-open-in-new" style="font-size: 0.8em; margin-left: 4px;"></i>
                                </a>
                            </td>

                            <td data-label="Created"><small class="text-gray-500">${dateStr}</small></td>
                            <td class="actions-cell">
                                <div class="buttons right nowrap">
                                    <a href="${finalEditUrl}" class="button small blue">
                                        <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }

            // Initial Render
            renderTable(allStories);

            // 3. Filter Logic
            function applyFilter() {
                const titleQuery = document.getElementById('filterTitle').value.toLowerCase().trim();

                const filtered = allStories.filter(item => {
                    return item.title.toLowerCase().includes(titleQuery);
                });

                renderTable(filtered);
            }

            // Bind Events
            document.getElementById('filterTitle').addEventListener('keyup', applyFilter);
           
            // Reset Logic
            document.getElementById('btnReset').addEventListener('click', function() {
                document.getElementById('filterTitle').value = '';
                renderTable(allStories);
            });
        });
    </script>
@endsection