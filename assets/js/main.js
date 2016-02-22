function navigateToSurvey(select) {
    window.location.href += '/../survey/' + select.value;
}

function highlightAnswer() {
    var cookie = getCookie("survey_answered[" + getURLID() + "]");

    if (cookie !== undefined) {
        cookie     = decodeURIComponent(cookie);
        cookieData = JSON.parse(cookie);
        
        var radios = document.querySelectorAll('input[type="radio"]');
        [].forEach.call(radios, function(el, k) {   
            el.setAttribute('disabled', 'disabled');
            if (el.value == cookieData.answer_id) {
                el.setAttribute('checked', 'checked');
            }
        })
    }

}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function getURLID() {
    var path    = document.location.pathname.split('/');
    var results = new Array;

    path.forEach(function(item, key) {
        if (item !== "") {
            results.push(item);
        }
    });

    if (results[results.length - 1]) {
        return results[results.length - 1];
    }
    return false;
}