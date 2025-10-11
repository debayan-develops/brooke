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
                <button type="button" data-target="add-features-modal" class="button blue --jb-modal">Add Category</button>
            </div>
        </section>

        <div id="add-features-modal" class="modal">
            <div class="modal-background --jb-modal-close"></div>
            <div class="modal-card">
                <form method="POST" action="{{ route('admin.contentCategory.create') }}">
                    @csrf
                    <header class="modal-card-head">
                        <p class="modal-card-title">Add New Category</p>
                    </header>
                    <section class="modal-card-body">
                        <div class="field">
                            <label class="label">Category Name</label>
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
                                    <label class="label">Category Type</label>
                                    <div class="control icons-left icons-right">
                                        <div class="select">
                                            <select id="categoryType" multiple name="categoryType[]">
                                                @foreach($categoryTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
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
    <div id="edit-category-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form id="edit-category" method="POST" action="">
                @csrf
                <input type="hidden" name="id" value="">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Category</p>
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
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Category Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="editCategoryType" multiple name="categoryType[]">
                                            @foreach($categoryTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
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

    <div id="delete-category-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form id="deleteCategory" method="POST" action="">
                @csrf
                @method('DELETE')
                <header class="modal-card-head">
                    <p class="modal-card-title">Delete {{$title}}</p>
                </header>
                <section class="modal-card-body">
                    <p>Are you sure you want to delete <span class="categoryName"></span>?</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>


        <section class="section main-section">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="notification red">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                            
                            <div>
                                <span class="icon"><i class="mdi mdi-buffer"></i></span>
                                <span>{{ $error }}</span>
                            </div>
                            
                            <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                        </div>
                    </div>
                @endforeach
            @endif
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
                    <th>Category Name</th>
                    <th>Category Type</th>
                    {{-- <th>City</th>
                    <th>Progress</th>
                    <th>Created</th> --}}
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $item)
                        <tr>
                            <td data-label="sl">{{$key+1}}</td>
                            <td data-label="Name">{{$item->name}}</td>
                            <td data-label="Type">{{$item->types->pluck('name')->join(', ')}}</td>

                            <td class="actions-cell">
                            <div class="buttons right nowrap">
                                <button type="button" data-target="edit-category-modal" class="button small blue edit-btn" data-id="{{$item->id}}"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></button>
                                <button class="button small red delete-btn" data-id="{{$item->id}}" data-name="{{$item->name}}" data-target="sample-modal" type="button">
                                    <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                </button>
                            </div>
                            </td>
                            
                        </tr>
                    @endforeach
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

    <div id="ajaxLoader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Choices('#categoryType', { removeItemButton: true, searchEnabled: true });
            const choices = new Choices('#editCategoryType', {
                    removeItemButton: true,
                    searchEnabled: true,
                });

            $('.edit-btn').on('click', function () {
                $('#modalShowBtn').attr('data-target', 'edit-category-modal');
                $('#ajaxLoader').fadeIn();
                const contentCategoryId = $(this).data('id');
                let routeTemplateEdit = "{{ route('admin.contentCategory.edit', ':contentCategory') }}";
                let routeTemplateUpdate = "{{ route('admin.contentCategory.update', ':contentCategory') }}";
                $('#edit-category-modal input[name="id"]').val('');
                $('#edit-category-modal input[name="name"]').val('');
                choices.clearStore();
                choices.clearChoices();
                $.get(routeTemplateEdit.replace(':contentCategory', contentCategoryId), function (data) {
                    $('#edit-category-modal input[name="id"]').val(data[0].id);
                    $('#edit-category-modal input[name="name"]').val(data[0].name);
                    $('#edit-category').attr('action', routeTemplateUpdate.replace(':contentCategory', contentCategoryId));
                    fetchType(data[0].types);
                    $('#ajaxLoader').fadeOut();
                    setTimeout(() => {
                        $('#modalShowBtn').click();
                    }, 500);
                }).fail(function () {
                    $('#ajaxLoader').fadeOut();
                    alert('Error fetching Category data.');
                });
            });
            let allTypes = @json($categoryTypes);
            function fetchType(types) {
                const selectedIds = types.map(type => type.id);
                // Clear existing options and set new ones
                choices.clearChoices();
                choices.setChoices(
                    allTypes.map(type => ({
                        value: type.id,
                        label: type.name,
                        selected: selectedIds.includes(type.id),
                        disabled: false,
                    })),
                    'value',
                    'label',
                    false
                );

            }
            
            $('.delete-btn').on('click', function () {
                $('#modalShowBtn').attr('data-target', 'delete-category-modal');
                const categoryId = $(this).data('id');
                $('#delete-category-modal input[name="id"]').val(categoryId);
                let routeTemplateDelete = "{{ route('admin.contentCategory.destroy', ':contentCategory') }}";
                $('#deleteCategory').attr('action', routeTemplateDelete.replace(':contentCategory', categoryId));
                const categoryName = $(this).data('name');
                    $('.categoryName').text(categoryName ? categoryName : 'this category');
                $('#modalShowBtn').click();

            });
        });

    </script>
@endsection