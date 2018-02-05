/**
 * Get data from API via GET
 *
 * @param call - URL to call
 * @param callback - Function to call when request has completed
 */
function api_get(call, callback)
{
    //if (window.XMLHttpRequest) {
    var request = new XMLHttpRequest();
    //} else {
    //var request = new ActiveXObject("Microsoft.XMLHTTP");
    //}
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            callback({ status: request.status, data: request.responseText });
        }
    };
    request.open('GET', 'api/' + call);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.setRequestHeader('Accept', 'application/json');
    request.send();
}
