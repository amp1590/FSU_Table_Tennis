//////////////////////////////AJAX

function runPageAjaxIntTable(url){
     var asynchronous4 = new Asynchronous();
     asynchronous4.complete = AsyncIntDiv;
     asynchronous4.call(url);
}

function runPageAjax(url){
     var asynchronous4 = new Asynchronous();
     asynchronous4.complete = AsyncMainDiv;
     asynchronous4.call(url);
}

//Do not change, part of AJAX
function Asynchronous( ) {
    this._xmlhttp = new FactoryXMLHttpRequest();
}
//Also part of AJAX, not necessary to modify
function Asynchronous_call(url) {
    var instance = this;
    this._xmlhttp.open('GET', url, true);
    this._xmlhttp.onreadystatechange = function() {
            switch(instance._xmlhttp.readyState) {
                case 1:
                   instance.loading();
                    break;
                case 2:
                    instance.loaded();
                    break;
                case 3:
                    instance.interactive();
                    break;
                case 4:
                    instance.complete(instance._xmlhttp.responseText);
                    break;
            }
        }
    this._xmlhttp.send(null);
}
function Asynchronous_loading() {
}
function Asynchronous_loaded() {
}
function Asynchronous_interactive() {
}
function Asynchronous_complete(responseText) {
}
    Asynchronous.prototype.loading = Asynchronous_loading;
    Asynchronous.prototype.loaded = Asynchronous_loaded;
    Asynchronous.prototype.interactive = Asynchronous_interactive;
    Asynchronous.prototype.complete = Asynchronous_complete;
    Asynchronous.prototype.call = Asynchronous_call;

//This is the function that updates the main div inside Dependencies.php or AddUpdatePackage.php
function AsyncMainDiv(responseText) {
    document.getElementById('main_div').innerHTML = "";
    document.getElementById('main_div').innerHTML = parseScript(responseText);
	// TODO RELOAD PAGE
}

function AsyncIntDiv(responseText) {
//	alert(responseText);
    document.getElementById('main_table_div').innerHTML = "";
    document.getElementById('main_table_div').innerHTML = parseScript(responseText);
	// TODO RELOAD PAGE
}
//Do not change, AJAX
function FactoryXMLHttpRequest() {
    if(window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {
        var msxmls = new Array(
        'Msxml2.XMLHTTP.5.0',
        'Msxml2.XMLHTTP.4.0',
        'Msxml2.XMLHTTP.3.0',
        'Msxml2.XMLHTTP',
        'Microsoft.XMLHTTP');
        for (var i = 0; i < msxmls.length; i++) {
            try {
                return new ActiveXObject(msxmls[i]);
            } catch (e) {}
        }
    }
    throw new Error("Could not instantiate XMLHttpRequest");
}

//This functions executes the returned javascript of ajax.
function parseScript(_source) {
    var source = _source;
    var scripts = new Array();

    // Strip out tags
    while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
            var s = source.indexOf("<script");
            var s_e = source.indexOf(">", s);
            var e = source.indexOf("</script", s);
            var e_e = source.indexOf(">", e);

            // Add to scripts array
            scripts.push(source.substring(s_e+1, e));
            // Strip from source
            source = source.substring(0, s) + source.substring(e_e+1);
    }

    // Loop through every script collected and eval it
    for(var i=0; i<scripts.length; i++) {
            try {
//                            alert(scripts[i]); // SHOWS WHAT WE ARE EXECUTING
                eval(scripts[i]);
            }
            catch(ex) {
                    // do what you want here when a script fails
            }
    }

    // Return the cleaned source
    return source;
}
