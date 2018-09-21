/**
 * Make API call
 *
 * @param method
 * @param call
 * @param callback
 * @private
 */
function _api_request(method, call, callback)
{
    //if (window.XMLHttpRequest) {
    var request = new XMLHttpRequest();
    //} else {
    //var request = new ActiveXObject("Microsoft.XMLHTTP");
    //}
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            callback({ status: request.status, data: request.responseText });
        }
    };
    request.open(method, 'api/' + call);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.setRequestHeader('Accept', 'application/json');
    request.send();
}

/**
 * Get data from API via GET
 *
 * @param call - URL to call
 * @param callback - Function to call when request has completed
 */
function api_get(call, callback)
{
    _api_request('GET', call, callback);
}

/**
 * Make API call via POST
 *
 * @param call
 * @param callback
 */
function api_post(call, callback)
{
    _api_request('POST', call, callback);
}
