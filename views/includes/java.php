<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<!-- Bootstrap 5.3.3 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Custom script for AJAX handling -->
<script>
    $(document).ready(function() {
    // Handle form submission for adding a category
    $('#add-category').on('submit', function(e) {
        e.preventDefault(); // Prevent normal form submission

        // Send the form data via AJAX
        $.ajax({
            url: $(this).attr('action'), // Form action URL
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                console.log(response); // Debug: Log the response to the console

                // Check if response is in JSON format
                try {
                    // Assuming the response is JSON
                    var category = JSON.parse(response);

                    // Check if the response contains the necessary data
                    if (category.category_id && category.category_name && category.description) {
                        // Append the new category to the table
                        $('table tbody').append(`
                            <tr>
                                <th scope="row">${category.category_id}</th>
                                <td>${category.category_name}</td>
                                <td>${category.description}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#category-modal-${category.category_id}">
                                            Edit
                                        </button>
                                        <form action="https://localhost/MASAWRAP/categories/delete" method="POST" class="mx-1">
                                            <input type="hidden" name="category_id" value="${category.category_id}">
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal fade" id="category-modal-${category.category_id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Edit Category</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="https://localhost/MASAWRAP/categories/update" method="POST" id="edit-category-${category.category_id}">
                                                        <div class="mb-3">
                                                            <label>Category</label>
                                                            <input type="text" class="form-control" name="category_name" value="${category.category_name}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Description</label>
                                                            <textarea class="form-control" name="description" rows="5">${category.description}</textarea>
                                                        </div>
                                                        <input type="hidden" name="category_id" value="${category.category_id}">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" form="edit-category-${category.category_id}" class="btn btn-primary">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `);

                        // Close the modal
                        $('#staticBackdrop').modal('hide');

                        // Reset the form fields
                        $('#add-category')[0].reset();
                    } else {
                        alert('Invalid response format.');
                    }
                } catch (e) {
                    alert('An error occurred while processing the response.');
                    console.error(e); // Debugging error log
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while adding the category.');
                console.error('Error: ' + error);
            }
        });
    });
});
