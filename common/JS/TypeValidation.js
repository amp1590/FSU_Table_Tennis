// notifdiv should contain the name of the cell to update
// collwarn is the name of the column in a table that contains the div
function validateVersion(ver, fileName, desc, notifdiv){
    
    not_div = document.getElementById(notifdiv);    
    if(!validateDates())
        return false;

    if(containsSQL(fileName)||containsSQL(desc)){
        not_div.style.display = "inline";
        not_div.innerHTML = " The 'file name' neither the 'description' should have SQL words like 'SELECT' ";
        return false;
    }
    if(!isVersion(ver)){
        not_div.style.display = "inline";
        not_div.innerHTML = " The 'version' field can only have points and numbers like: '3.01.05' ";
        return false;
    }

    return true;
}

function validateDates(){    
    var stardate = document.getElementById("txtStartDate").value;
    var endDate = document.getElementById("txtEndDate").value;
    //Check if the start date has a valid format
    var date_fmt_msg ="The date format is yyyy-mm-dd";

    not_div = document.getElementById("notif_div");
    not_div.style.display = "none";//In the case there where previous warning

    if(!isDateFormat(stardate)){
        document.getElementById("txtStartDate").value = getDefaultStartDate();
        not_div.style.display = "inline";
        not_div.innerHTML=date_fmt_msg;
        return false;
    }
    //Check if the end date has a valid format
    if(!isDateFormat(endDate)){
        document.getElementById("txtEndDate").value = getDefaultEndDate();
        not_div.style.display = "inline";
        not_div.innerHTML=date_fmt_msg+" or 'Active' for the end date";
        return false;
    }
    return true;
}

//Validate the date format. This function is only to know if the format is right
// but is not used to display the error to the user.
function isDateFormat(dateValue){
    var datefmt = /(^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$)|(^(Active)$)/;
    if(!datefmt.test(dateValue)){
        return false;
    }
    return true;
}

function containsSQL(field){
   var rx = /^.*SELECT+.*$/;
   if(!rx.test(field))
        return false;

   return true;
}

////Validates version numbers, in this case they can be:
// Only numbers: 2132
// Numbers with points in the midle: 3.22.3312
function isVersion(field){
   var rx = /^[0-9]+([.]{1}[0-9]+)*$/;
   if(!rx.test(field))
        return false;

   return true;
}


//-------------------------------------------------------------------
// hasWrittenNumber(objEvent)
//   Returns true if key pressed is a digit
//-------------------------------------------------------------------

function hasWrittenNumber(objEvent)
{
        var charCode = (objEvent.which) ? objEvent.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;

        return true;
}

//-------------------------------------------------------------------
// hasWrittenFloatNumber(objEvent)
//   Returns true if key pressed is part of a float number
//-------------------------------------------------------------------

function hasWrittenFloatNumber(objEvent)
{
        if (navigator.appVersion.indexOf("MSIE")>-1)
        {
                var iKeyCode;
                iKeyCode = objEvent.keyCode;
                if((iKeyCode>=48 && iKeyCode<=57) || iKeyCode==46){
                    return true;
                }
                return false;
        }
        return false;
}

//-------------------------------------------------------------------
// isInteger(value)
//   Returns true if value contains all digits
//-------------------------------------------------------------------
function isInteger(val)
{
        if (isBlank(val))
        {
                return false;
        }

        for(var i=0;i<val.length;i++)
        {
                if(!isDigit(val.charAt(i)))
                {
                        return false;
                }
        }

        return true;
}

//-------------------------------------------------------------------
// isNumeric(value)
//   Returns true if value contains a positive float value
//-------------------------------------------------------------------
function isNumeric(val)
{
        return(parseFloat(val,10)==(val*1));
}

//-------------------------------------------------------------------
// isDigit(value)
//   Returns true if value is a 1-character digit
//-------------------------------------------------------------------
function isDigit(num)
{
    alert(num.value);
    if (num.length>1)
                return false;
        var string="1234567890";
        if (string.indexOf(num)!=-1)
            {
            alert(num);
                return true;
                }
        return false;
}

//-------------------------------------------------------------------
// isBlank(value)
//   Returns true if value only contains spaces
//-------------------------------------------------------------------
function isBlank(val)
{
        if(val==null)
                return true;
        for(var i=0;i<val.length;i++)
        {
                if ((val.charAt(i)!=' ')&&(val.charAt(i)!="\t")&&(val.charAt(i)!="\n")&&(val.charAt(i)!="\r"))
                        return false;
        }
        return true;
}

//-------------------------------------------------------------------
// fixFloat(field)
//   Returns true if value contains a positive float value
//-------------------------------------------------------------------
function fixFloat(fld)
{
  if (!fld.value.length||fld.disabled)
        return true; // blank fields are the domain of requireValue

  val = parseFloat(fld.value);
  if(isNaN(val))
  {
        fld.value= '0';
        return false;
  }

  return true;
}

//-------------------------------------------------------------------
// isEmail(field)
//   Returns true if value contains a correct email address
//-------------------------------------------------------------------
function isEmail(fld)
{
        if(!fld.value.length || fld.disabled)
                return true; // blank fields are the domain of requireValue

        var emailfmt = /(^['_A-Za-z0-9-]+(\.['_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.(([A-Za-z]{2,3})|(aero|coop|info|museum|name))$)|^$/;
        if(!emailfmt.test(fld.value))
                return false;

        return true;
}
//-------------------------------------------------------------------
// hasOnlyLetters(field)
//   Returns true if field contain letters, accent point or comas
//-------------------------------------------------------------------
function lettersAccentComaAndPoint(field){
        var rx = /^[a-zA-Z|\s|'.'|','|'á'|'é'|'í'|'ó'|'ú'|'Á'|'É'|'Í'|'Ó'|'Ú']+$/;
        if(!rx.test(field.value))
                return false;

        return true;
}
//-------------------------------------------------------------------
// hasOnlyLetters(field)
//   Returns true if value contains only lower or uppercase letters
//-------------------------------------------------------------------
function hasOnlyLetters(fld){
        var rx = /^[a-zA-Z]+$/;
        if(!rx.test(fld.value))
                return false;

        return true;
}

//-------------------------------------------------------------------
// objectExists(obj)
//   Returns true if obj is not null and is not undefined
//-------------------------------------------------------------------
function objectExists(obj)
{
        if (obj == null || typeof(obj) == "undefined")
                return false;

        return true;
}

//-------------------------------------------------------------------
// isSubmition(evt)
//   Returns true if evt is an event of an enter key pressed
//-------------------------------------------------------------------
function isSubmition(evt)
{
        var characterCode;

        if(evt && evt.which)  //if which property of event object is supported (NN4)
        {
                evt = evt;
                characterCode = evt.which; //character code is contained in NN4's which property
        }
        else
        {
                evt = event;
                characterCode = evt.keyCode; //character code is contained in IE's keyCode property
        }

        if(characterCode == 13) //if generated character code is equal to ascii 13 (if enter key)
                return true;
        else
                return false;
}

//-------------------------------------------------------------------
// preventSubmition(evt)
//   Returns true if evt is not an event of an enter key pressed
//   so it can be used to prevent submition by checking a false value
//-------------------------------------------------------------------
function preventSubmition(evt)
{
        return !isSubmition(evt);
}

//-------------------------------------------------------------------
// isAtLeastOneSelected(form)
//   Returns true if at least one checkbox of the form is checked
//-------------------------------------------------------------------
function isAtLeastOneSelected(form)
{
        var inputCheck = form.getElementsByTagName("input");

        for (var inputIndex=0;inputIndex<inputCheck.length;inputIndex++)
                if (inputCheck[inputIndex].type == "checkbox" &&
                        inputCheck[inputIndex].checked == true)
                        return true;

        return false;
}

//-------------------------------------------------------------------
// hasSelectedOptions(obj)
//   Returns true if at least one option of the select object is selected
//-------------------------------------------------------------------
function hasSelectedOptions(obj)
{
        for (var i=0;i<obj.options.length;i++)
                if (obj.options[i].selected == true)
                        return true;

        return false;
}

//-------------------------------------------------------------------
// isEmtpy(val)
//   Returns true if value contains something and not only spaces
//-------------------------------------------------------------------
function isEmpty(val)
{
        if (val == null ||
                val.length == 0 ||
                isBlank(val))
                return true;

        return false;
}

//-------------------------------------------------------------------
// isDate(val)
//   Returns true if value contains a valid date, false if not
//-------------------------------------------------------------------
function isDate(dateStr)
{
        var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
        var matchArray = dateStr.match(datePat); // is the format ok?

        if (matchArray == null)
                return false;

        month = matchArray[3]; // p@rse date into variables
        day = matchArray[1];
        year = matchArray[5];

        if (month < 1 || month > 12)
                return false;

        if (day < 1 || day > 31)
                return false;

        if ((month==4 || month==6 || month==9 || month==11) && day==31)
                return false;

        if (month == 2)
        { // check for february 29th
                var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
                if (day > 29 || (day==29 && !isleap))
                        return false;
        }

        if (year < 1900 || year > 2999)
                return false;

        return true;
}


function checkrequired(which) {
    var pass=true;
    var tempobj='';
    var nombre='';
    
    if (document.images){
        for (i=0;i<which.length;i++) {
            tempobj=which.elements[i];
            nombre=tempobj.name;
            if ((tempobj.type=="text" || tempobj.type=="password") && tempobj.value==''){
                pass=false;
                break;
            }
        }
    }    		
    if (!pass) {
        shortFieldName=tempobj.name.toUpperCase();
        alert("Aseg�rese de que el campo "+shortFieldName+" haya sido llenado correctamente.");
        return false;
    }
    else
        return true;
  }

  var solicitud = null;