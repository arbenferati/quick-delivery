function editProduct(url, data) {
    $('#edit-product-form').attr('action', url);
    $('#edit-modal-label').html('Modification de "' + data['name'] + '"');
    $('#edit-product-name').val(data['name']);
}

function confirmDialog(title, body, url) {
    $('#confirmation-btn').attr('href', url);
    $('#confirmation-modal-label').html(title);
    $('#confirmation-body-text').html(body);
}
