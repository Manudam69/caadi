var id_revision;
function enviarRevision(revision) {
    id_revision = revision;
}

$("#botonRev").click(function () {
    $("<input />").attr("type", "hidden")
        .attr("name", "id_revision")
        .attr("value", "" + id_revision)
        .appendTo("#formRevision");
    $("#formRevision").submit();
})