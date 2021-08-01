function o(i)
{
    return typeof i == 'object' ? i : document.getElementById(i)
}

function s(i)
{
    return o(i).style
}

function c(i)
{
    return document.getElementsByClassName(i)
}