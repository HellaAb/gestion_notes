function disPartsNone(){
    document.getElementById('indicators').style.display = "none"
    for (let i=1 ; i<5 ;i++){
        document.getElementById('part'+i).style.display = "none"
    }
}
function disNone(){
    document.getElementById('foot').style.display = "none"
    document.getElementById('intro').style.display = "none"
    // disPartsNone()
}