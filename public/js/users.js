/**
 * Set modal title
 * @param title
 */
function setModalTitle(title) {
    $('#userModalTitle').text(title);
}

/**
 * Show modal
 */
function showModal() {
    $('#userModal').modal('show');
}

/**
 * Clear form fields in modal
 */
function clearModal()
{
    $('#firstName').val('');
    $('#lastName').val('');
    $('#phoneNumber').val('');
    $('#email').val('');
    $('#username').val('');
    $('#password').val('');
}

/**
 * Open modal for adding new user
 */
function addUser() {
    setModalTitle('Lisää käyttäjä');
    clearModal();

    $('#userForm').attr('method', 'POST');

    showModal();
}

/**
 * Open modal for editing user
 *
 * @param id - User ID
 */
function editUser(id) {
    setModalTitle('Muokkaa käyttäjää');
    clearModal();

    $('#userForm').attr('method', 'UPDATE');

    showModal();
}

/**
 * Create new user
 *
 * @param data
 */
function insertUser(data = null) {
    if (data === null) {
        api_post('user', insertUser);
        return;
    }

    if (data['status'] !== 200) {
        alert('fail!!');
    } else {
        alert('Success!');
    }
}

/**
 * Send form via AJAX
 */
$('#userForm').submit(function(e) {
    e.preventDefault();

    let method = $('#userForm').attr('method');
    if (method === 'POST') {
        insertUser();
    } else if (method === 'UPDATE') {
        updateUser();
    } else {
        alert('Unsupported method `' + method + '` in form!');
    }
});
