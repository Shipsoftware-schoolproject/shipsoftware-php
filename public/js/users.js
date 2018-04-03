function setModalTitle(title) {
    $('#userModalTitle').text(title);
}

function showModal() {
    $('#userModal').modal('show');
}

function clearModal()
{
    $('#firstName').val('');
    $('#lastName').val('');
    $('#phoneNumber').val('');
    $('#email').val('');
    $('#username').val('');
    $('#password').val('');
}

function addUser() {
    setModalTitle('Lisää käyttäjä');
    clearModal();

    $('#userForm').attr('method', 'POST');

    showModal();
}

function editUser(id) {
    setModalTitle('Muokkaa käyttäjää');
    clearModal();

    $('#userForm').attr('method', 'UPDATE');

    showModal();
}

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
