const ic_loader='<div class="text-center"><div class="loader"></div></div>';
const ic_done='<div style="font-size: 5rem;" class="ic ic-done text-success"></div>';
const ic_error='<div style="font-size: 5rem;" class="ic ic-error text-warning"></div>';
const ic_catch='<div style="font-size: 5rem;" class="ic ic-bug text-danger"></div>';
$.fn.formToJson=function(){form=$(this);var formArray=form.serializeArray(),jsonOutput={};return $.each(formArray,(function(i,element){var elemNameSplit=element.name.split("["),elemObjName="jsonOutput";$.each(elemNameSplit,(function(nameKey,value){nameKey!=elemNameSplit.length-1?(elemObjName="]"==value.slice(value.length-1)?"]"===value?elemObjName+"["+Object.keys(eval(elemObjName)).length+"]":elemObjName+"["+value:elemObjName+"."+value,void 0===eval(elemObjName)&&eval(elemObjName+" = {};")):"]"==value.slice(value.length-1)?"]"===value?eval(elemObjName+"["+Object.keys(eval(elemObjName)).length+"] = '"+element.value.replace("'","\\'")+"';"):eval(elemObjName+"["+value+" = '"+element.value.replace("'","\\'")+"';"):eval(elemObjName+"."+value+" = '"+element.value.replace("'","\\'")+"';")}))})),jsonOutput};
function reload_on_navigate(){const [entry] = performance.getEntriesByType("navigation");if (entry["type"] === "back_forward")location.reload();}
function GEBI(id){return document.getElementById(id);}
$.fn.setNow=function(t){var e=new Date($.now()),g=e.getFullYear()+"-"+(1===(e.getMonth()+1).toString().length?"0"+(e.getMonth()+1).toString():e.getMonth()+1)+"-"+(1===e.getDate().toString().length?"0"+e.getDate().toString():e.getDate())+"T"+(1===e.getHours().toString().length?"0"+e.getHours().toString():e.getHours())+":"+(1===e.getMinutes().toString().length?"0"+e.getMinutes().toString():e.getMinutes())+":"+(1===e.getSeconds().toString().length?"0"+e.getSeconds().toString():e.getSeconds());return!0===t&&$(this).val()?this:($(this).val(g),this)};