import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

    document.addEventListener('DOMContentLoaded', function () {
       const deleteButtons = document.querySelectorAll('.js-delete-btn');
       const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
       const postTitleElement = document.getElementById('post-title');
       const deleteForm = document.getElementById('delete-form');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function () {
               const postId = this.getAttribute('data-post-id');
               const postTitle = this.getAttribute('data-post-title');
                
                postTitleElement.textContent = postTitle;
                deleteForm.action = '/admin/posts/' + postId;

                confirmDeleteModal.show();
            });
        });
    });
