/**
 * public/js/rich-editor.js
 * Central Configuration for all Rich Text Editors
 */
function initializeRichEditor(selector) {
    const element = document.querySelector(selector);
    if (!element) return;

    // Remove existing editor if it exists to prevent duplicates
    if (element.classList.contains('ck-editor__editable')) {
        return;
    }
const {
				ClassicEditor,
				Essentials,
				Bold,
				Italic,
				Font,
				Paragraph,
				Alignment,
				Heading,
				List,
				Indent,
				IndentBlock,
				Link,
				BlockQuote
			} = CKEDITOR;

			ClassicEditor
				.create( element, {
					licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE4MDIzMDM5OTksImp0aSI6IjM0MGVkNWIyLTlkMjQtNDJhOC04ZjI3LTdjMjA1ZDM5NzA3ZSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJyZW1vdmVGZWF0dXJlcyI6WyJQQiIsIlJGIiwiU0NIIiwiVENQIiwiVEwiLCJUQ1IiLCJJUiIsIlNVQSIsIkI2NEEiLCJMUCIsIkhFIiwiUkVEIiwiUEZPIiwiV0MiLCJGQVIiLCJCS00iLCJGUEgiLCJNUkUiXSwidmMiOiIzMjA3YTA4MiJ9.cZdxJL4iM46d8EZ35WQhalHcsqU4dL5aG8CRM4NKnJ6rHUYmRQHyLeq89jFC51y9i8YCaIOkmZPWKxPurSbIOA',
					plugins: [ Essentials, Bold, Italic, Font, Paragraph, Alignment, Heading, List, Indent, IndentBlock, Link, BlockQuote],
					toolbar: [
						'undo', 'redo', '|', 'bold', 'italic', '|',
						'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
						'alignment', '|', 'heading', 'bulletedList', 'numberedList', 'indent', 'outdent', 'link', 'blockQuote'
					]
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( error );
				} );
    // CKEDITOR.ClassicEditor is available via the Super Build CDN
    // CKEDITOR.ClassicEditor.create(element, {
    //     // 1. Toolbar including Alignment
    //     toolbar: {
    //         items: [
    //             'heading', '|',
    //             'bold', 'italic', 'underline', 'strikethrough', 'code', '|',
    //             'alignment', // <--- NEW ALIGNMENT FEATURE
    //             'bulletedList', 'numberedList', 'todoList', '|',
    //             'outdent', 'indent', '|',
    //             'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
    //             'undo', 'redo',
    //             // Add 'sourceEditing' here if you want to view HTML
    //         ],
    //         shouldNotGroupWhenFull: true
    //     },

    //     // 2. Alignment Configuration
    //     alignment: {
    //         options: [ 'left', 'center', 'right', 'justify' ]
    //     },

    //     // 3. General Settings
    //     language: 'en',
    //     placeholder: 'Type your content here...',
        
    //     // 4. Image/Media Upload (Optional - Add your uploadUrl here if needed)
    //     // simpleUpload: { uploadUrl: '/your-upload-endpoint' },

    // })
    // .then(editor => {
    //     console.log(`Rich Editor initialized for: ${selector}`);
    // })
    // .catch(error => {
    //     console.error('Editor Error:', error);
    // });
}
