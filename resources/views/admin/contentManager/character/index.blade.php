@extends('layouts.admin')

@section('title', $title ?? 'Admin Panel')

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    
    /* FIX 1: Force Bullets & Numbers inside CKEditor in Admin */
    .ck-content ul {
        list-style-type: disc !important;
        padding-left: 20px !important;
    }
    .ck-content ol {
        list-style-type: decimal !important;
        padding-left: 20px !important;
    }
    .ck-content li {
        display: list-item !important; /* Forces the dot to appear */
    }
    /* Filter Section Styling */
    .filter-section { background: #f9fafb; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 20px; align-items: flex-end; }
    .filter-group { flex: 1; }
    .filter-group label { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 5px; color: #374151; }
    .filter-input { width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; }
    .filter-actions { display: flex; gap: 10px; }
    .modal.is-active { display: flex !important; }

    /* CKEditor Custom Height */
    .ck-editor__editable { min-height: 200px; }
    
    /* FIX: Make the form fill the modal so Footer buttons always show */
    .modal-card form {
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 40px);
        overflow: hidden; /* Prevents double scrollbars */
    }
    .modal-card-body {
        flex-grow: 1;
        overflow-y: auto;
    }
</style>

@section('content')
    <div id="app">
        @include('admin.partials.top_nav')
        @include('admin.partials.nav')

        <section class="is-title-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <ul><li>Admin</li><li>{{$title}}</li></ul>
            </div>
        </section>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">{{$title}}</h1>
                <button type="button" id="btnAddCharacter" class="button blue">Add Character</button>
            </div>
        </section>

        <section class="section main-section" style="padding-bottom: 0;">
            <div class="filter-section">
                <div class="filter-group">
                    <label>Character Name</label>
                    <input type="text" id="filterName" class="filter-input" placeholder="Search Name...">
                </div>
                <div class="filter-group">
                    <label>Character Type</label>
                    <input type="text" id="filterType" class="filter-input" placeholder="Search Type...">
                </div>
                <div class="filter-actions">
                    <button type="button" id="btnFilter" class="button blue">Filter</button>
                    <button type="button" id="btnReset" class="button red">Reset</button>
                </div>
            </div>
        </section>

        <section class="section main-section">
            @if(session('success'))
                <div class="notification green">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                        <div><span class="icon"><i class="mdi mdi-buffer"></i></span> <span>{{ session('success') }}</span></div>
                        <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                    </div>
                </div>
            @endif

            <div class="card has-table">
                <header class="card-header"><p class="card-header-title"><span class="icon"><i class="mdi mdi-account-multiple"></i></span> List</p></header>
                <div class="card-content">
                    <table>
                        <thead><tr><th>#</th><th>Name</th><th>Character Type</th><th>Actions</th></tr></thead>
                        <tbody id="characterTableBody"></tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div id="add-character-modal" class="modal">
        <div class="modal-background close-modal" data-target="add-character-modal"></div>
        <div class="modal-card" style="width: 800px; max-width: 95%;"> 
            <form method="POST" action="{{ route('admin.characters.store') }}">
                @csrf
                <header class="modal-card-head">
                    <p class="modal-card-title">Add New Character</p>
                    <button type="button" class="delete close-modal" data-target="add-character-modal"></button>
                </header>
                
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control icons-left">
                            <input class="input" type="text" name="name" required>
                            <span class="icon left"><i class="mdi mdi-account"></i></span>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Description</label>
                        <div class="control">
                            <textarea id="addDescriptionEditor" name="description" placeholder="Character Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Type</label>
                        <div class="select w-full">
                            <select id="characterType" multiple name="categoryType[]">
                                @foreach($categoryTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>
                
                <footer class="modal-card-foot">
                    <button type="submit" class="button green">Save</button>
                    <button type="button" class="button close-modal" data-target="add-character-modal">Cancel</button>
                </footer>
            </form>
        </div>
    </div>

    <div id="edit-character-modal" class="modal">
        <div class="modal-background close-modal" data-target="edit-character-modal"></div>
        <div class="modal-card" style="width: 800px; max-width: 95%;"> 
            <form id="edit-character-form" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Character</p>
                    <button type="button" class="delete close-modal" data-target="edit-character-modal"></button>
                </header>
                
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control icons-left">
                            <input class="input" type="text" name="name" required>
                            <span class="icon left"><i class="mdi mdi-account"></i></span>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Description</label>
                        <div class="control">
                            <textarea id="editDescriptionEditor" name="description" placeholder="Character Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Type</label>
                        <div class="select w-full">
                            <select id="editCharacterType" multiple name="categoryType[]">
                                @foreach($categoryTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>
                
                <footer class="modal-card-foot">
                    <button type="submit" class="button green">Update</button>
                    <button type="button" class="button close-modal" data-target="edit-character-modal">Cancel</button>
                </footer>
            </form>
        </div>
    </div>

    <div id="delete-character-modal" class="modal">
        <div class="modal-background close-modal" data-target="delete-character-modal"></div>
        <div class="modal-card">
            <form id="delete-character-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <header class="modal-card-head">
                    <p class="modal-card-title">Delete Character</p>
                    <button type="button" class="delete close-modal" data-target="delete-character-modal"></button>
                </header>
                <section class="modal-card-body">
                    <p>Are you sure you want to delete <strong class="characterName"></strong>?</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button red">Delete</button>
                    <button type="button" class="button close-modal" data-target="delete-character-modal">Cancel</button>
                </footer>
            </form>
        </div>
    </div>

    <div id="ajaxLoader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); color: #3b82f6; font-weight: bold;">Loading...</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const allCharacters = @json($characters); 
            const allTypes = @json($categoryTypes);

            // --- CKEditor Initialization ---
            let addEditorInstance;
            let editEditorInstance;

            ClassicEditor
                .create(document.querySelector('#addDescriptionEditor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                })
                .then(editor => { addEditorInstance = editor; })
                .catch(error => { console.error(error); });

            ClassicEditor
                .create(document.querySelector('#editDescriptionEditor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                })
                .then(editor => { editEditorInstance = editor; })
                .catch(error => { console.error(error); });
            // -------------------------------

            function renderTable(data) {
                const tbody = document.getElementById('characterTableBody');
                tbody.innerHTML = ''; 

                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center p-4">No records found</td></tr>';
                    return;
                }

                data.forEach((item, index) => {
                    let typeNames = 'None';
                    if (item.types && item.types.length > 0) {
                        typeNames = item.types.map(t => t.name).join(', ');
                    }

                    let row = `
                        <tr>
                            <td data-label="sl">${index + 1}</td>
                            <td data-label="Name">${item.name}</td>
                            <td data-label="Type"><span class="tag is-light">${typeNames}</span></td>
                            <td class="actions-cell">
                                <div class="buttons right nowrap">
                                    <button type="button" class="button small blue edit-btn" data-id="${item.id}"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></button>
                                    <button type="button" class="button small red delete-btn" data-id="${item.id}" data-name="${item.name}"><span class="icon"><i class="mdi mdi-trash-can"></i></span></button>
                                </div>
                            </td>
                        </tr>`;
                    tbody.innerHTML += row;
                });
            }

            renderTable(allCharacters);

            function applyFilter() {
                const nameQuery = document.getElementById('filterName').value.toLowerCase().trim();
                const typeQuery = document.getElementById('filterType').value.toLowerCase().trim();

                const filtered = allCharacters.filter(item => {
                    const nameMatch = item.name.toLowerCase().includes(nameQuery);
                    let itemTypeString = (item.types && item.types.length > 0) ? item.types.map(t => t.name).join(' ').toLowerCase() : '';
                    const typeMatch = itemTypeString.includes(typeQuery);
                    return nameMatch && typeMatch;
                });
                renderTable(filtered);
            }

            document.getElementById('btnFilter').addEventListener('click', applyFilter);
            document.getElementById('filterName').addEventListener('keyup', applyFilter);
            document.getElementById('filterType').addEventListener('keyup', applyFilter);

            document.getElementById('btnReset').addEventListener('click', function() {
                document.getElementById('filterName').value = '';
                document.getElementById('filterType').value = '';
                renderTable(allCharacters);
            });

            const addChoices = new Choices('#characterType', { removeItemButton: true });
            const editChoices = new Choices('#editCharacterType', { removeItemButton: true });

            function toggleModal(modalId, show) {
                const modal = document.getElementById(modalId);
                if (show) modal.classList.add('is-active');
                else modal.classList.remove('is-active');
            }

            document.getElementById('btnAddCharacter').addEventListener('click', function() {
                if(addEditorInstance) addEditorInstance.setData('');
                toggleModal('add-character-modal', true);
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('close-modal') || e.target.classList.contains('modal-background')) {
                    toggleModal(e.target.getAttribute('data-target'), false);
                }

                const editBtn = e.target.closest('.edit-btn');
                if (editBtn) {
                    const id = editBtn.getAttribute('data-id');
                    toggleModal('edit-character-modal', true);
                    $('#ajaxLoader').fadeIn();

                    let editUrl = "{{ route('admin.characters.edit', 'DUMMY_ID') }}".replace('DUMMY_ID', id);
                    let updateUrl = "{{ route('admin.characters.update', 'DUMMY_ID') }}".replace('DUMMY_ID', id);

                    document.querySelector('#edit-character-form input[name="id"]').value = '';
                    document.querySelector('#edit-character-form input[name="name"]').value = '';
                    if(editEditorInstance) editEditorInstance.setData(''); 
                    editChoices.clearStore();

                    $.get(editUrl, function (data) {
                        const char = (Array.isArray(data)) ? data[0] : data;
                        
                        document.querySelector('#edit-character-form input[name="id"]').value = char.id;
                        document.querySelector('#edit-character-form input[name="name"]').value = char.name;
                        
                        if(editEditorInstance) editEditorInstance.setData(char.description || '');

                        document.getElementById('edit-character-form').action = updateUrl;

                        const selectedIds = char.types ? char.types.map(t => t.id) : [];
                        const choicesData = allTypes.map(type => ({
                            value: type.id, label: type.name, selected: selectedIds.includes(type.id)
                        }));
                        editChoices.setChoices(choicesData, 'value', 'label', true);
                        $('#ajaxLoader').fadeOut();
                    }).fail(function() {
                        $('#ajaxLoader').fadeOut();
                        alert('Error fetching data');
                        toggleModal('edit-character-modal', false);
                    });
                }

                const deleteBtn = e.target.closest('.delete-btn');
                if (deleteBtn) {
                    const id = deleteBtn.getAttribute('data-id');
                    const name = deleteBtn.getAttribute('data-name');
                    let deleteUrl = "{{ route('admin.characters.destroy', 'DUMMY_ID') }}".replace('DUMMY_ID', id);
                    document.getElementById('delete-character-form').action = deleteUrl;
                    document.querySelector('.characterName').innerText = name;
                    toggleModal('delete-character-modal', true);
                }
            });
        });
    </script>
@endsection