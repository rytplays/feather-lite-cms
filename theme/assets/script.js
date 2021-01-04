const toggler=document.getElementById("toggler");
const nbar=document.getElementById("nbar");
const overlay=document.getElementById("overlay");
function show_nbar()
{
    toggler.setAttribute("class","ic ic-close");
    nbar.style.display="block";
    overlay.style.display="block";
    toggler.onclick=function(){hide_nbar();}
}
function hide_nbar()
{
    toggler.setAttribute("class","ic ic-menu");
    nbar.style.display="none";
    overlay.style.display="none";
    toggler.onclick=function(){show_nbar();}
}